<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Nameable;
use Byancode\Congruent\Traits\Modelable;

class Tag extends Model
{
    use Modelable, Typeable, Nameable;
    
    protected $table = 'tags';
    const type = 'tag';
    
    protected $fillable = [
        'name',
        'type_id', 
        'options', 
        'details'
    ];

    protected $casts = [
        'options' => 'object',
        'details' => 'object'
    ];
}