<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;
use Byancode\Congruent\Traits\Commentable;

class Entry extends Model
{
    use Modelable, Typeable, Commentable;
    
    protected $table = 'entries';
    const type = 'entry';
    
    protected $fillable = [
        'details', 
        'options',
        'index_at'
    ];

    protected $casts = [
        'details' => 'object',
        'options' => 'object',
        'index_at' => 'datetime',
    ];
}