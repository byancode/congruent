<?php
namespace Byancode\Congruent\Traits;
use Byancode\Congruent\App\Activity;
use Illuminate\Support\Facades\Auth;
use Byancode\Congruent\App\Signin;

trait Activityable
{
    public function activity()
    {
        return $this->morphOne(Activity::class, 'subjectable')->orderBy('id', 'DESC');
    }
    public function createActivity(string $type, array $data = [])
    {
        return $this->createActivityAs(Auth::user(), $type, $data);
    }
    public function createActivityAs($author, string $type, array $data = [])
    {
        return $this->morphOne(Activity::class, 'subjectable')->create([
            'author_type' => $type,
            'author_id' => $author->id,
            'author_type' => \get_class($author),
            'details' => $data,
        ]);
    }
    public function activities()
    {
        return $this->morphMany(Activity::class, 'subjectable');
    }
}