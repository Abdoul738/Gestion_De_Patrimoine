<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Patrimoine $patrimoine, $comment_id = null)
    {
        Comment::create ([
            'content' => $request->input('message' . $comment_id),
            'pat_id' => $patrimoine->id,
            'user_id' => $request->user()->id,
            'parent_id' => $comment_id,
        ]);

        if (!$request->user()->valid) {
            $request->session()->flash('warning', __('Merci pour votre commentaire. Il apparaîtra lorsqu\'un administrateur l\'aura validé.<br>Une fois que vous êtes validé, vos autres commentaires apparaissent immédiatement.'));
        }
        if($request->ajax()) {
            return response()->json();
        }
        return back();
    }
}
