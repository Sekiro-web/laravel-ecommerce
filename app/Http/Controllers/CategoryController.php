<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = category::all();
        return view('Categories.index', [
            'categories' => $categories
        ]);
    }

    public function addCategory()
    {
        $categories = category::all();
        return view('Categories.add_category', [
            'categories' => $categories
        ]);
    }

    public function editCategory($id)
    {
        $category = category::findOrFail($id);
        return view('Categories.edit_category', [
            'category' => $category
        ]);
    }


    public function ControlCategory(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:5'],
        ]);
        if (!$request->id) {
            // add category
            $request->validate([
                'name' => ['unique:categories'],
                'imgpath' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048']
            ]);
            $path = $request->imgpath->move('assets/img', Str::uuid()->toString() . '_' . $request->file('imgpath')->getClientOriginalName());

            $category = new Category();
            $category->name = request('name');
            $category->imgpath = $path;
            $category->save();

            return redirect('/categories');
        } else {
            // edit product
            $target = category::findorfail($request->id);
            if ($request->imgpath) {

                $request->validate([
                    'imgpath' => ['image', 'mimes:jpg,png,jpeg', 'max:2048']
                ]);

                if ($target->imgpath && File::exists(public_path($target->imgpath))) {
                    File::delete(public_path($target->imgpath));
                }

                $path = $request->imgpath->move('assets/img', Str::uuid()->toString() . '_' . $request->file('imgpath')->getClientOriginalName());
                $target->name = $request->input('name');
                $target->imgpath = $path;
                $target->save();
            } else {

                $target->name = $request->input('name');
                $target->save();
            }
            return redirect('/categories');
        }
    }

    public function deleteCategory($id)
    {
        $target_product = category::findorfail($id);
        $target_product->delete();

        return redirect('/categories');
    }
}
