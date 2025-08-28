<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Feedback;
use App\Models\HomeSlider;
use Illuminate\Http\Request;

class FirstController extends Controller
{
    public function MainPage()
    {
        $categories = category::all();
        $Feedback = Feedback::whereRelation('FeedbackStatus', 'status', 'Approaved')->orderBy('created_at', 'desc')->take(3)->get();
        $SliderImages = HomeSlider::all();
        return view('main_page', [
            'categories' => $categories,
            'Feedback' => $Feedback,
            'SliderImages' => $SliderImages
        ]);
    }

    public function ContactPage()
    {
        return view('contact');
    }

    public function CartPage()
    {
        return view('cart');
    }

    public function checkOut()
    {
        return view('checkOut');
    }
}
