<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;

class Singular extends Model
{
    use Modelable, Typeable;
    
    protected $table = 'singulars';
    const type = 'singular';
    
    protected $fillable = [
        'name',
        'options', 
        'profile',
        'index_at'
    ];

    protected $casts = [
        'details' => 'object',
        'profile' => 'object',
        'birthday' => 'date',
        'deathday' => 'date'
    ];
}