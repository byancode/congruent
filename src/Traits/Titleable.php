<?php
namespace Byancode\Congruent\Traits;

use Byancode\Congruent\App\Title;

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