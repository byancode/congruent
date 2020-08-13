<?php
namespace App\Traits;
use Byancode\Library\RC4;

trait Titleable
{
    public function meta()
    {
        return $this->morphOne(Title::class, 'subjectable');
    }

    public function metas()
    {
        return $this->morphMany(Title::class, 'subjectable');
    }
}