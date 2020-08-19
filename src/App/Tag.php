<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Nameable;
use Byancode\Congruent\Traits\Modelable;
use Byancode\Congruent\Traits\Statusable;
use Byancode\Congruent\Traits\Activityable;

class Tag extends Model
{
    use Modelable, Typeable, Nameable, Statusable, Activityable;
    
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