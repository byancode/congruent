<?php
namespace Byancode\Congruent\App;

use Illuminate\Support\Facades\Auth;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;
use Byancode\Congruent\Traits\Statusable;
use Byancode\Congruent\Traits\Commentable;
use Byancode\Congruent\Traits\Activityable;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Relation extends MorphPivot
{
    use Modelable, Typeable, Statusable, Commentable, Activityable;
    
    protected $table = 'relationables';
    protected $dateFormat = 'Y-m-d H:i:s.u';

    protected $fillable = [
        'type_id',
        'modelable_id',
        'modelable_type',
    ];

    protected $hidden = [
        'modelable_id',
        'modelable_type',
        'relationable_id',
        'relationable_type',
    ];

    protected $casts = [
        'details' => 'object',
    ];
}