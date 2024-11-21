<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'post_id', 'parent_comment_id', 'depth'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }

    public static function validateDepth($parentCommentId = null)
    {
        $maxDepth = 3;
        $depth = 1;

        if ($parentCommentId) {
            $parent = self::find($parentCommentId);
            if ($parent) {
                $depth = $parent->depth + 1;
            }
        }

        return $depth <= $maxDepth;
    }
}
