<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('announcements.index', compact('announcements'));
    }

    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    public function create()
    {
        $this->authorize('create', Announcement::class);
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Announcement::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:50',
            'is_featured' => 'boolean',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['is_published'] = true;
        $validated['published_at'] = now();

        Announcement::create($validated);

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully');
    }

    public function edit(Announcement $announcement)
    {
        $this->authorize('update', $announcement);
        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $this->authorize('update', $announcement);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:50',
            'is_featured' => 'boolean',
        ]);

        $announcement->update($validated);

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully');
    }

    public function destroy(Announcement $announcement)
    {
        $this->authorize('delete', $announcement);
        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully');
    }
}
