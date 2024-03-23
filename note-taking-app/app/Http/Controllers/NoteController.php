<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    // Show all notes for the authenticated user
public function index()
{
    $notes = auth()->user()->notes;
    return view('notes.index', compact('notes'));
}

// Show the form for creating a new note
public function create()
{
    return view('notes.create');
}

// Store a newly created note
public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'content' => 'required',
    ]);

    $note = auth()->user()->notes()->create($request->all());

    return redirect()->route('notes.index')->with('success', 'Note created successfully.');
}

// Show the form for editing a note
public function edit(Note $note)
{
    $this->authorize('update', $note);

    return view('notes.edit', compact('note'));
}

// Update an existing note
public function update(Request $request, Note $note)
{
    $this->authorize('update', $note);

    $request->validate([
        'title' => 'required',
        'content' => 'required',
    ]);

    $note->update($request->all());

    return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
}

// Delete a note
public function destroy(Note $note)
{
    $this->authorize('delete', $note);

    $note->delete();

    return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
}

public function search(Request $request)
{
    $query = $request->input('query');
    $notes = auth()->user()->notes()
        ->where('title', 'like', "%$query%")
        ->orWhere('content', 'like', "%$query%")
        ->get();

    return view('notes.index', compact('notes'));
}

}
