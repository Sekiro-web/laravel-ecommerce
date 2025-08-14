<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Badwords;
use App\Models\Feedback;

class AboutController extends Controller
{
    public function AboutPage()
    {
        $Feedback = Feedback::all();
        return view('about', [
            'Feedback' => $Feedback
        ]);
    }

    public function StoreFeedback(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30', 'alpha:ascii'],
            'email' => ['required', 'email', 'ends_with:.com'],
            'subject' => ['required', 'min:3', 'max:30'],
            'message' => ['required', new Badwords]
        ]);
        $Feedback = new Feedback();
        $Feedback->name = $request->name;
        $Feedback->email = $request->email;
        $Feedback->subject = $request->subject;
        $Feedback->message = $request->message;

        $Feedback->save();
        return redirect('/feedback');
    }
}
