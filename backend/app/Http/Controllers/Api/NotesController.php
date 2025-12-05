<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    // GET /notes – Fetch all notes
    public function index(Request $request)
    {
        return Notes::where('user_id', $request->user()->id)->get();
    }

    // POST /notes – Create new note
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return Notes::create([
            'user_id' => $request->user()->id,
            'title'   => $request->title,
            'description' => $request->description,
        ]);
    }

    // PUT /notes/{id} – Update note
    public function update(Request $request, $id)
    {
        $note = Notes::where('user_id', $request->user()->id)->findOrFail($id);

        $request->validate([
            'title'   => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $note->update($request->only(['title', 'description']));

        return $note;
    }

    // DELETE /notes/{id} – Delete note
    public function destroy(Request $request, $id)
    {
        $note = Notes::where('user_id', $request->user()->id)->findOrFail($id);

        $note->delete();

        return response()->json(['message' => 'Note deleted']);
    }
}
