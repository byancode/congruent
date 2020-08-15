<?php
namespace Byancode\Congruent\Traits;

use Byancode\Congruent\App\Name;

trait Nameable
{
    public function meta()
    {
        return $this->morphOne(Name::class, 'subjectable');
    }

    public function metas()
    {
        return $this->morphMany(Name::class, 'subjectable');
    }
}