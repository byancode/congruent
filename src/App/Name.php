<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    protected $table = 'names';
    
    protected $fillable = [
        'name', 
        'description',
        'locale_id', 
        'data', 
    ];

    protected $casts = [
        'data' => 'object'
    ];
}