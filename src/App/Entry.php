<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;

class Entry extends Model
{
    use Modelable, Typeable;
    
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