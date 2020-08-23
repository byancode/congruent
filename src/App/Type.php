<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Nameable;
use Byancode\Congruent\Traits\Statusable;
use Byancode\Congruent\Traits\Activityable;

class Type extends Model
{
    use Nameable, Statusable, Activityable;
    
    protected $table = 'types';
    protected $dateFormat = 'Y-m-d H:i:s.u';
    public $incrementing = false;
    
    protected $fillable = [
        'id',
        'model'
    ];

    protected $hidden = [
        'model'
    ];

}