<?php
namespace Byancode\Congruent\Traits;

use Byancode\Congruent\App\File;
use Illuminate\Support\Facades\Auth;

trait Fileable
{
    public function files()
    {
        return $this->fileables(File::class);
    }

    public function fileable(string $relation)
    {
        return $this->morphOne($relation, 'fileable');
    }
    public function fileables(string $relation)
    {
        return $this->morphMany($relation, 'fileable');
    }
}