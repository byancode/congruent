<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;
use Byancode\Congruent\Traits\Statusable;
use Byancode\Congruent\Traits\Activityable;

class Role extends Model
{
    use Modelable, Typeable, Statusable, Activityable;
    
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