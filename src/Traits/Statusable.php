<?php
namespace Byancode\Congruent\Traits;

use Byancode\Congruent\App\Status;
use Illuminate\Support\Facades\Auth;

trait Statusable
{
    public function status()
    {
        return $this->morphOne(Status::class, 'subjectable')->latest('id');
    }
    public function setStatusAttribute(string $type)
    {
        return $this->createStatus($type);
    }
    public function createStatus(string $type)
    {
        return $this->createStatusAs(Auth::user(), $type);
    }
    public function createStatusAs($user, string $type)
    {
        return $this->morphOne(Status::class, 'subjectable')->create([
            'type_id' => $type,
            'author_id' => $user->id,
            'author_type' => \get_class($user)
        ]);
    }
    public function statuses()
    {
        return $this->morphMany(Status::class, 'subjectable');
    }
}