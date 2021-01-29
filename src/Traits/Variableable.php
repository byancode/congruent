<?php
namespace Byancode\Congruent\Traits;

use Byancode\Congruent\App\Variable;

trait Variableable
{
    public function variable(string $class)
    {
        return $this->morphOne($class, 'author');
    }
}