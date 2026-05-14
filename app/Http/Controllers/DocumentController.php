<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('documents.index', compact('documents'));
    }

    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    public function create()
    {
        $this->authorize('create', Document::class);
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Document::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|max:51200',
            'category' => 'required|string|max:50',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('documents', 'public');

        Document::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $filePath,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize(),
            'category' => $validated['category'],
            'uploaded_by' => auth()->id(),
            'is_published' => true,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully');
    }

    public function download(Document $document)
    {
        $document->increment('download_count');
        return Storage::download($document->file_path);
    }

    public function destroy(Document $document)
    {
        $this->authorize('delete', $document);
        Storage::delete($document->file_path);
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully');
    }
}
