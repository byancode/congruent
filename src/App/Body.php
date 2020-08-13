<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;

class Body extends Model
{
    protected $table = 'bodies';
    
    protected $fillable = [
        'text',
        'locale_id', 
        'data', 
    ];

    protected $casts = [
        'data' => 'object'
    ];
}