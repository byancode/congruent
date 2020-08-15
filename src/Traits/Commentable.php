<?php
namespace Byancode\Congruent\Traits;
use Byancode\Congruent\App\Comment;
use Illuminate\Support\Facades\Auth;

trait Commentable
{
    public function comment(string $text)
    {
        return $this->commentAs(Auth::user(), $text);
    }
    public function commentAs(Model $user, string $text)
    {
        return $this->morphOne(Comment::class, 'subjectable')->create([
            'body' => $text,
            'author_id' => $user->id,
            'author_type' => \get_class($user)
        ]);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'subjectable')->where();
    }
}