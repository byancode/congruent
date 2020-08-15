<?php
namespace Byancode\Congruent\Traits;

use Byancode\Congruent\App\Status;
use Illuminate\Support\Facades\Auth;

trait Statusable
{
    public function setStatusAttribute(string $type)
    {
        return $this->statusAs(Auth::user(), $text);
    }
    public function statusAs(Model $user, string $type)
    {
        return $this->morphOne(Status::class, 'subjectable')->create([
            'type_id' => $type,
            'author_id' => $user->id,
            'author_type' => \get_class($user)
        ]);
    }
    public function statuses()
    {
        return $this->statusesBy(Auth::user());
    }
    public function statusesBy(Model $user)
    {
        return $this->morphMany(Status::class, 'subjectable')->where([
            'author_id'=> $user->id,
            'author_type'=> \get_class($user)
        ]);
    }
}