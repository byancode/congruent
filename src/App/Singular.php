<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;
use Byancode\Congruent\traits\Singleable;
use Byancode\Congruent\Traits\Statusable;
use Byancode\Congruent\Traits\Commentable;
use Byancode\Congruent\Traits\Activityable;

class Singular extends Model
{
    use Modelable, Typeable, Commentable, Singleable, Statusable, Activityable;
    
    protected $table = 'singulars';
    protected $dateFormat = 'Y-m-d H:i:s.u';
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