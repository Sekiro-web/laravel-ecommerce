<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Badwords;
use App\Models\Feedback;
use App\Models\FeedbackCause;
use App\Models\FeedbackStatus;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function AboutPage()
    {
        $Feedback = Feedback::whereNotNull('approval')
            ->where('approval', 'Yes')
            ->get();
        return view('About.index', [
            'Feedback' => $Feedback
        ]);
    }

    public function StoreFeedback(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30'],
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
        return redirect('/about');
    }

    public function ReviewFeedback($status = null)
    {
        $Reasons = null;
        $RejectionStat = null;
        $ApproavedStat = null;
        if (!$status) {
            $Feedback = Feedback::whereNull('feedback_status_id')->get();
            $Reasons = FeedbackCause::all();
            $ApproavedStat = FeedbackStatus::where('status', 'Approaved')->first();
        } elseif ($status == 'Approaved') {
            $Feedback = Feedback::whereRelation('FeedbackStatus', 'status', 'Approaved')->with('FeedbackStatus', 'user')->get();
            $Reasons = FeedbackCause::all();
        } elseif ($status == 'Rejected') {
            $Feedback = Feedback::whereRelation('FeedbackStatus', 'status', 'Rejected')->with('FeedbackStatus', 'FeedbackCause', 'user')->get();
            $ApproavedStat = FeedbackStatus::where('status', 'Approaved')->first();
        }


        return view('About.feedback', [
            'Feedback' => $Feedback,
            'Reasons' => $Reasons,
            'RejectionStat' => $RejectionStat,
            'ApproavedStat' => $ApproavedStat
        ]);
    }

    public function ApproveFeedback($id)
    {
        //find
        $target = Feedback::findOrFail($id);
        //save
        $status_id = FeedbackStatus::where('status', 'Approaved')->first()->id;

        $target->feedback_status_id = $status_id;
        $target->user_id = Auth::user()->id;
        $target->updated_at = now();
        $target->save();
        //redirect
        return back()->with('success', 'Feedback Approaved Successfully');
    }

    public function RejectFeedback(Request $request)
    {
        //validate
        $request->validate([
            'cause' => ['required', 'integer', 'exists:feedback_causes,id'],
            'feedback_id' => ['required', 'integer', 'exists:feedback,id']
        ]);
        //find
        $target = Feedback::findOrFail($request->feedback_id);
        //save
        $status_id = FeedbackStatus::where('status', 'Rejected')->first()->id;

        $target->feedback_status_id = $status_id;
        $target->feedback_cause_id = $request->cause;
        $target->user_id = Auth::user()->id;
        $target->updated_at = now();
        $target->save();
        //redirect
        return back()->with('success', 'Feedback Rejected Successfully');
    }

    public function DeleteFeedback($id)
    {
        //find
        $target = Feedback::findOrFail($id);
        //delete
        $target->delete();
        //redirect
        return back()->with('success', 'Feedback Deleted Successfully');
    }
}
