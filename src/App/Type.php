<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Nameable;

class Type extends Model
{
    use Nameable;
    
    protected $table = 'types';
    public $incrementing = false;
    
    protected $fillable = [
        'id',
        'model'
    ];

    protected $hidden = [
        'model'
    ];

}