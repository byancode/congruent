<?php
namespace Byancode\Congruent\Traits;

use Byancode\Congruent\App\Variable;

trait Variableable
{
    public function variable(string $key, string $class = null)
    {
        return $this->morphOne($class ?? Variable::classs, 'author')->where('key', $key);
    }
    public function variableable(string $class)
    {
        return $this->morphMany($class, 'author');
    }
}