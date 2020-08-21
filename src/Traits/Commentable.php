<?php
namespace Byancode\Congruent\Traits;

use Illuminate\Support\Facades\Auth;
use Byancode\Congruent\App\Comment;

trait Commentable
{
    public function comment()
    {
        return $this->morphOne(Comment::class, 'subjectable')->orderBy('id', 'DESC');
    }
    public function setCommentAttribute(string $text)
    {
        return $this->createComment($text);
    }
    public function createComment(string $text)
    {
        return $this->createCommentAs(Auth::user(), $text);
    }
    public function createCommentAs(Model $user, string $text)
    {
        return $this->morphOne(Comment::class, 'subjectable')->create([
            'body' => $text,
            'author_id' => $user->id,
            'author_type' => \get_class($user)
        ]);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'subjectable');
    }
}