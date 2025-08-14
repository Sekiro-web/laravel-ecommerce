<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\ProductsImages;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function ProductPage(Request $request, $name = null)
    {
        $categories = category::all();
        $search = $request->query('search');
        $sort = $request->query('sort');
        $query = products::with('firstImage');
        $id = null;

        if ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }
        if ($name) {
            $category = Category::where('name', $name)->firstOrFail();
            $id = $category->id;
            $query->where('category_id', $id);
        }

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->simplePaginate(6)->appends($request->query());

        return view('Products.index', [
            'products' => $products,
            'categories' => $categories,
            'active_id' => $id
        ]);
    }

    public function ProductsTable()
    {
        $products = products::with('category', 'Images')->get();
        return view('Products.products_table', [
            'products' => $products
        ]);
    }

    public function productDetails($id)
    {
        $product = products::with('category', 'firstImage')->findOrFail($id);
        $related_products = products::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)->whereBetween('price', [
                $product->price - 200,
                $product->price + 200
            ])->take(3)->get();

        // dd($product);

        return view('Products.product_details', [
            'product' => $product,
            'related_products' => $related_products
        ]);
    }

    public function addProduct()
    {
        $categories = category::all();
        return view('Products.add_product', [
            'categories' => $categories
        ]);
    }

    public function editProduct($id)
    {
        $categories = category::all();
        $product = products::with('Images')->findOrFail($id);
        return view('Products.edit_product', [
            'categories' => $categories,
            'product' => $product
        ]);
    }

    public function ControlProduct(Request $request)
    {
        // auth
        $request->validate([
            'name' => ['required', 'min:5'],
            'price' => ['required', 'numeric', 'min:1'],
            'quantity' => ['required', 'integer', 'min:1'],
            'category_id' => ['required'],
        ]);
        // add product
        if (!$request->id) {
            $request->validate([
                'name'      => ['unique:products,name'],
                'images'    => ['required', 'array', 'min:1', 'max:4'],
                'images.*'  => ['image', 'mimes:jpg,jpeg,png', 'max:3072'],
            ], [
                'images.required' => 'Please upload at least one image.',
                'images.min'      => 'You must upload at least 1 image.',
                'images.max'      => 'You can upload up to 4 images only.',
                'images.*.image'  => 'Each file must be a valid image.',
                'images.*.mimes'  => 'Images must be in JPG or PNG format.',
                'images.*.max'    => 'Each image must not exceed 3MB.',
            ]);

            $product = products::create([
                'name' => request('name'),
                'price' => request('price'),
                'quantity' => request('quantity'),
                'description' => request('description'),
                'category_id' => request('category_id'),
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->images as $image) {
                    $path = $image->move('assets/img', Str::uuid()->toString() . '_' . $image->getClientOriginalName());
                    ProductsImages::create([
                        'name' => $path,
                        'products_id' => $product->id
                    ]);
                }
            }

            return redirect('products');
        } else {
            // edit product
            $target = products::findorfail($request->id);

            $target->update([
                'name' => request('name'),
                'price' => request('price'),
                'quantity' => request('quantity'),
                'description' => request('description'),
                'category_id' => request('category_id'),
            ]);

            $previousUrl = $request->previousUrl;
            if (str_contains($previousUrl, 'ProductsTable')) {
                return redirect('/ProductsTable');
            } else {
                return redirect('/products');
            }
        }
    }

    public function deleteProduct($id)
    {
        $product = Products::findOrFail($id);

        // 🔹 Delete all related images from disk & DB
        $images = ProductsImages::where('products_id', $product->id)->get();
        foreach ($images as $image) {
            if ($image->name && File::exists(public_path($image->name))) {
                File::delete(public_path($image->name));
            }
            $image->delete();
        }

        // 🔹 Delete the product itself
        $product->delete();

        // 🔹 Redirect back to correct page
        $previousUrl = url()->previous();
        return str_contains($previousUrl, 'ProductsTable')
            ? redirect('/ProductsTable')->with('success', 'Product deleted successfully.')
            : redirect('/products')->with('success', 'Product deleted successfully.');
    }

    public function addProductImage(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'images' => 'required|array|min:1|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ], [
            'images.required' => 'Please upload at least one image.',
            'images.min'      => 'You must upload at least 1 image.',
            'images.max'      => 'You can upload up to 4 images only.',
            'images.*.image'  => 'Each file must be a valid image.',
            'images.*.mimes'  => 'Images must be JPG, PNG, GIF, or WEBP.',
            'images.*.max'    => 'Each image must not exceed 5MB.',
        ]);

        try {
            // Find the product
            $product = Products::findOrFail($validated['product_id']);
            $savedImages = [];

            foreach ($request->file('images') as $image) {
                $path = $image->move('assets/img', Str::uuid()->toString() . '_' . $image->getClientOriginalName());

                $productImage = ProductsImages::create([
                    'name' => $path,
                    'products_id' => $product->id
                ]);

                $savedImages[] = $productImage;
            }

            return response()->json([
                'success' => true,
                'message' => 'Images uploaded successfully',
                'images' => $savedImages
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error uploading images: ' . $e->getMessage()
            ], 500);
        }
    }


    public function deleteProductImage($id)
    {
        $image = ProductsImages::findOrFail($id);

        // Delete the file from storage
        if ($image->name && File::exists(public_path($image->name))) {
            File::delete(public_path($image->name));
        }

        // Delete the DB record
        $image->delete();

        return redirect('ProductsTable')->with('success', 'Product image deleted successfully.');
    }
}
