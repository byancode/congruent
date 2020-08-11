<?php

namespace Byancode\Congruent\Traits;

use Byancode\Congruent\Kind;

trait Kindable
{
    public function about()
    {
        return $this->belongsTo(Kind::class, 'kind', 'kind')->where('model', self::class);
    }
    public static function scopeKind($query)
    {
        return Kind::where([
            'kind' => static::make()->getAttribute('kind'),
            'model'=> self::class
        ]);
    }
    public static function kinds()
    {
        return Kind::where('model', self::class);
    }
}