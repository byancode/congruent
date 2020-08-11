<?php

namespace Byancode\Congruent;

use Illuminate\Database\Eloquent\Model;

class Names extends Model
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