<?php

namespace Byancode\Congruent\App;

use Illuminate\Support\Arr;
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
    protected $dateFormat = 'Y-m-d H:i:s.u';
    const type = 'pending';
    
    protected $fillable = [
        'type_id'
    ];
    
    public static function scopeOn($query, $types)
    {
        return $query->whereIn('type_id', Arr::wrap($types));
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