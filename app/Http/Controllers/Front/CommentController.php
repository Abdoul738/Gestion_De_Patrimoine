<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view('comments.index', ['comments'=>Comment::with('post')->get()]);
    }

    public function update(Request $request, Comment $comment)
    {
        $validatedData = $request->validate([
            'title'=>'required|min:2|max:255',
            'author'=>'required|min:2|max:50',
            'content'=>'required|min:5',
        ]);
        if($comment->reported) {
            $comment->update(array_merge($validatedData, ['reported' => 0]));
        } else {
            $comment->update($validatedData);
        }
        return redirect()->back()->with('success', 'Le commentaire a été modifié');
    }
}
