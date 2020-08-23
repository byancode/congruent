<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;
use Byancode\Congruent\Traits\Statusable;
use Byancode\Congruent\Traits\Commentable;
use Byancode\Congruent\Traits\Activityable;

class Comment extends Model
{
    use Modelable, Typeable, Commentable, Statusable, Activityable;
    
    protected $table = 'comments';
    protected $dateFormat = 'Y-m-d H:i:s.u';
    const type = 'comment';
    
    protected $fillable = [
        'body',
        'type_id',
        'parent_id', 
        'options',
    ];

    protected $casts = [
        'options' => 'object'
    ];

    public function parent()
    {
        return $this->main()->hasOne(self::class, 'id', 'parent_id');
    }
}