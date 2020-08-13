<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;

class Activity extends Model
{
    use Modelable, Typeable;
    
    protected $table = 'activities';
    const type = 'created';
    
    protected $fillable = [
        'type_id'
    ];
}