<?php

namespace Byancode\Congruent\App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;
use Byancode\Congruent\Traits\Commentable;
use Byancode\Congruent\Traits\Activityable;

class Status extends Model
{
    use Modelable, Typeable, Commentable, Activityable;
    
    protected $table = 'statuses';
    const type = 'pending';
    
    protected $fillable = [
        'type_id'
    ];

    
    public static function scopeApproved($query)
    {
        return $query->where('type_id', 'approved');
    }
    
    public function scopeAs($query, $model)
    {
        return $query->where([
            'author_id' => $model->id,
            'author_type' => \get_class($model)
        ]);
    }

    public function scopeMe($query)
    {
        return $this->scopeAs(Auth::user());
    }
}