<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;

class Status extends Model
{
    use Modelable, Typeable;
    
    protected $table = 'statuses';
    const type = 'pending';
    
    protected $fillable = [
        'type_id'
    ];
    
}