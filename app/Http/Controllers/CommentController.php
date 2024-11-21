<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'parent_comment_id' => 'nullable|exists:comments,id', // Ensure parent exists
        ]);

        Log::info('Request data:', $request->all());

        $parentCommentId = $request->input('parent_comment_id');

        if ($parentCommentId) {
            $parentComment = Comment::find($parentCommentId);
            if ($parentComment) {
                $depth = $parentComment->depth + 1;
            } else {
                return back()->with('error', 'Parent comment not found.');
            }
        } else {
            $depth = 1;
        }

        if ($depth > 3) {
            return back()->with('error', 'You can only comment up to 3 levels deep.');
        }

        $comment = new Comment([
            'content' => $request->input('content'),
            'post_id' => $post->id,
            'parent_comment_id' => $parentCommentId,
            'depth' => $depth,
        ]);

        Log::info('Saving comment:', $comment->toArray());

        $post->comments()->save($comment);

        return redirect()->route('posts.show', $post);
    }
}
