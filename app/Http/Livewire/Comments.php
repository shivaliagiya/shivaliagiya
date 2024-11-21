<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class Comments extends Component
{
    public $post;
    public $content;
    public $parentCommentId;
    public $depthLimit = 3;

    protected $rules = [
        'content' => 'required|string|max:500',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function addComment($parentCommentId = null)
    {
        $this->validate();

        $parentComment = $parentCommentId ? Comment::find($parentCommentId) : null;
        $currentDepth = $parentComment ? $parentComment->depth + 1 : 1;

        if ($currentDepth > $this->depthLimit) {
            session()->flash('error', 'Comments cannot exceed the maximum depth.');
            return;
        }

        Comment::create([
            'content' => $this->content,
            'post_id' => $this->post->id,
            'parent_comment_id' => $parentCommentId,
            'depth' => $currentDepth,
        ]);

        $this->reset('content', 'parentCommentId');
        session()->flash('message', 'Comment added successfully.');
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => $this->post->comments()->whereNull('parent_comment_id')->with('replies')->get(),
        ]);
    }
}
