<?php
namespace Byancode\Congruent\Traits;

trait Modelable
{
    public function inheritAttributes(array $attributes)
    {
        $this->original = $attributes;
        $this->attributes = $attributes;
        return $this;
    }
    public function main()
    {
        return (new self())->inheritAttributes(['type_id' => static::type] + $this->attributes);
    }
    public function getMainClassAttribute()
    {
        return self::class;
    }
    public static function mainClass()
    {
        return self::class;
    }
}