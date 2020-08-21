<?php
namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Statusable;
use Byancode\Congruent\Traits\Activityable;

class Body extends Model
{
    use Statusable, Activityable;

    protected $table = 'bodies';
    
    protected $fillable = [
        'text',
        'locale_id', 
        'data', 
    ];

    protected $casts = [
        'data' => 'object'
    ];
}