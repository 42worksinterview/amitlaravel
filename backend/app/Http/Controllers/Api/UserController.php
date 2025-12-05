<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // GET /notes – Fetch all notes
    public function login(Request $request)
    {
        return Note::where('user_id', $request->user()->id)->get();
    }

    // POST /notes – Create new note
    public function register(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return Note::create([
            'user_id' => $request->user()->id,
            'title'   => $request->title,
            'description' => $request->description,
        ]);
    }
}
