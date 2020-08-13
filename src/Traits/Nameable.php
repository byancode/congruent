<?php
namespace App\Traits;

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