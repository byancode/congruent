<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;

class Role extends Model
{
    use Modelable, Typeable;
    
    protected $table = 'roles';
    const type = 'role';
    
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