<?php
namespace Byancode\Congruent\Traits;

use Byancode\Congruent\App\Activity;
use Illuminate\Support\Facades\Auth;

trait Activityable
{
    public function activity()
    {
        return $this->morphOne(Activity::class, 'subjectable')->latest();
    }
    public function createActivity(string $type, array $data = [])
    {
        return $this->createActivityAs(Auth::user(), $type, $data);
    }
    public function createActivityAs($author, string $type, array $data = [])
    {
        return $this->morphOne(Activity::class, 'subjectable')->create([
            'type_id' => $type,
            'details' => $data,
            'author_id' => $author->id,
            'author_type' => \get_class($author),
        ]);
    }
    public function activities()
    {
        return $this->morphMany(Activity::class, 'subjectable');
    }
}