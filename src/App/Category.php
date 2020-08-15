<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;
use Byancode\Congruent\Traits\Commentable;

class Category extends Model
{
    use Modelable, Typeable, Commentable;
    
    protected $table = 'categories';
    const type = 'category';
    
    protected $fillable = [
        'name',
        'type_id',
        'parent_id', 
        'options', 
        'details'
    ];

    protected $casts = [
        'options' => 'object',
        'details' => 'object'
    ];

    public function parent()
    {
        return $this->main()->hasOne(self::class, 'id', 'parent_id');
    }
}