<?php

namespace Byancode\Congruent;

use Illuminate\Database\Eloquent\Model;

class Titles extends Model
{
    protected $table = 'titles';
    
    protected $fillable = [
        'title', 
        'description',
        'locale_id', 
        'data', 
    ];

    protected $casts = [
        'data' => 'object'
    ];
}