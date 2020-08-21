<?php
namespace Byancode\Congruent\App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;

class Activity extends Model
{
    use Modelable, Typeable;
    
    protected $table = 'activities';
    const type = 'created';
    
    protected $fillable = [
        'type_id', 
        'details',
        'author_id',
        'author_type',
    ];

    protected $hidden = [
        'author_id',
        'author_type',
        'subjectable_id',
        'subjectable_type',
    ];

    protected $casts = [
        'details' => 'object',
    ];

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

    public function subjectable()
    {
        return $this->morphTo('subjectable');
    }
}