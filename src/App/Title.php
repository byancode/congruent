<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Statusable;
use Byancode\Congruent\Traits\Activityable;

class Title extends Model
{
    use Statusable, Activityable;

    protected $table = 'titles';
    protected $dateFormat = 'Y-m-d H:i:s.u';
    
    protected $fillable = [
        'title', 
        'description',
        'locale_id', 
        'data', 
    ];

    protected $casts = [
        'data' => 'object'
    ];
}