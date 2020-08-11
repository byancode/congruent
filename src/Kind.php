<?php

namespace Byancode\Congruent;

use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    protected $table = 'kinds';
    
    protected $fillable = [
        'model', 
        'kind'
    ];

    protected $hidden = [
        'model'
    ];

    public function meta()
    {
        return $this->morphOne(Names::class, 'subjectable');
    }

    public function metas()
    {
        return $this->morphMany(Names::class, 'subjectable');
    }

}