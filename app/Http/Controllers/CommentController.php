<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Photo;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Photo $photo)
    {
        $request->validate([
            'content' => 'required',
        ]);

        if ($photo->comments->count() >= 7) {
            return redirect()->back()->with('error', 'Maximum comments per photo reached.');
        }

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->photo_id = $photo->id;
        $comment->user_id = auth()->id();
        $comment->save();

        return redirect()->route('photo.index', ['photo' => $photo])->with('success', 'Comment was added successfully!');
    }

    public function destroy(int $id)
    {
        $comment = Comment::findOrFail($id);
        
        if ($comment->user_id == auth()->id() || 'admin' === auth()->user()->role) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        }
    }
}
