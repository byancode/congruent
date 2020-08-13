<?php

namespace Byancode\Congruent\Traits;

use Byancode\Congruent\Observers\TypeableObserver;
use Byancode\Congruent\Scopes\TypeableScope;
use Byancode\Congruent\Type;

trait Typeable
{
    public function type()
    {
        return $this->belongsTo(Type::class)->where('model', self::class);
    }
    public static function scopeType($query)
    {
        return Type::where([
            'id' => static::type,
            'model'=> self::class
        ]);
    }
    public static function Types()
    {
        return Type::where('model', self::class);
    }

    protected static function boot() {
        static::observe(TypeableObserver::class);
        static::addGlobalScope(new TypeableScope);
    }
}