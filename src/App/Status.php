<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;
use Byancode\Congruent\Traits\Commentable;

class Status extends Model
{
    use Modelable, Typeable, Commentable;
    
    protected $table = 'statuses';
    const type = 'pending';
    
    protected $fillable = [
        'type_id'
    ];

    
    public static function scopeApproved($query)
    {
        return $query->where('type_id', 'approved');
    }
    
}