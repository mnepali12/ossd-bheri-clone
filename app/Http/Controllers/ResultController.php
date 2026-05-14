<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        if (auth()->user()->isStudent()) {
            $results = Result::where('student_id', auth()->id())
                ->orderBy('exam_date', 'desc')
                ->paginate(10);
        } else {
            $results = Result::with('student')
                ->orderBy('exam_date', 'desc')
                ->paginate(10);
        }

        return view('results.index', compact('results'));
    }

    public function show(Result $result)
    {
        if (auth()->user()->isStudent() && $result->student_id !== auth()->id()) {
            abort(403);
        }

        return view('results.show', compact('result'));
    }

    public function create()
    {
        $this->authorize('create', Result::class);
        $students = User::whereHas('role', fn($q) => $q->where('name', 'Student'))->get();

        return view('results.create', compact('students'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Result::class);

        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:100',
            'marks_obtained' => 'required|integer|min:0',
            'total_marks' => 'required|integer|min:1',
            'grade' => 'required|string|max:2',
            'exam_date' => 'required|date',
        ]);

        $validated['percentage'] = ($validated['marks_obtained'] / $validated['total_marks']) * 100;

        Result::create($validated);

        return redirect()->route('results.index')->with('success', 'Result added successfully');
    }
}
