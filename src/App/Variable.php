<?php

namespace Byancode\Congruent\App;

use Illuminate\Database\Eloquent\Model;
use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;
use Byancode\Congruent\Traits\Statusable;
use Byancode\Congruent\Traits\Activityable;

class Variable extends Model
{
    use Modelable, Typeable, Statusable, Activityable;

    protected $table = 'variables';
    const type = 'variable';

    protected $dateFormat = 'Y-m-d H:i:s.u';
    
    protected $fillable = [
        'key',
        'value'
    ];

    protected $hidden = [
        'type_id',
        'author_id',
        'author_type'
    ];
    
    public function getValueAttribute(string $data)
    {
        return \json_decode($data ?: 'null', true);
    }
    public function setValueAttribute($data)
    {
        $this->attributes['value'] = \json_encode($data);
    }
}