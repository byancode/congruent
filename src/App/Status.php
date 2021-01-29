<?php

namespace Byancode\Congruent\App;

use Byancode\Congruent\Traits\Activityable;
use Byancode\Congruent\Traits\Commentable;
use Byancode\Congruent\Traits\Modelable;
use Byancode\Congruent\Traits\Typeable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class Status extends Model
{
    use Modelable, Typeable, Commentable, Activityable;

    protected $table = 'statuses';
    protected $dateFormat = 'Y-m-d H:i:s.u';

    protected $fillable = [
        'type_id',
        'author_id',
        'author_type',
    ];

    protected $hidden = [
        'type_id',
        'author_id',
        'author_type',
        'subjectable_id',
        'subjectable_type',
        'updated_at',
    ];

    protected $appends = [
        'code',
    ];

    public static function scopeIs($query, $types)
    {
        if (
            ($item = $query->latest('id')->first()) &&
            \in_array($item->type_id, Arr::wrap($types))
        ) {
            return $item;
        } else {
            return null;
        }
    }
    public static function scopeHas($query, $types)
    {
        return boolval(static::scopeIs($query, $types));
    }
    public static function scopeAvailable($query)
    {
        return $query->latest('id')->first();
    }

    public function scopeAs($query, $model)
    {
        return $query->where([
            'author_id' => $model->id,
            'author_type' => \get_class($model),
        ]);
    }

    public function scopeMe($query)
    {
        return $this->scopeAs(Auth::user());
    }

    public function getCodeAttribute()
    {
        return $this->getOriginal('type_id');
    }
}
