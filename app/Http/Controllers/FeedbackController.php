<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin() || auth()->user()->isStaff()) {
            $feedbacks = Feedback::orderBy('created_at', 'desc')->paginate(10);
        } else {
            $feedbacks = Feedback::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('feedbacks.index', compact('feedbacks'));
    }

    public function show(Feedback $feedback)
    {
        if (auth()->user()->isStudent() && $feedback->user_id !== auth()->id()) {
            abort(403);
        }

        return view('feedbacks.show', compact('feedback'));
    }

    public function create()
    {
        return view('feedbacks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'category' => 'required|string|max:50',
        ]);

        Feedback::create([
            'user_id' => auth()->id(),
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'category' => $validated['category'],
            'status' => 'open',
            'priority' => 'medium',
        ]);

        return redirect()->route('feedbacks.index')->with('success', 'Feedback submitted successfully');
    }

    public function reply(Request $request, Feedback $feedback)
    {
        $this->authorize('update', $feedback);

        $validated = $request->validate([
            'reply_message' => 'required|string',
        ]);

        $feedback->update([
            'reply_message' => $validated['reply_message'],
            'replied_by' => auth()->id(),
            'replied_at' => now(),
            'status' => 'resolved',
        ]);

        return redirect()->route('feedbacks.show', $feedback)->with('success', 'Reply sent successfully');
    }
}
