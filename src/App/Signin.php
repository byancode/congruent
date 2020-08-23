<?php

namespace Byancode\Congruent\App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Byancode\Congruent\Traits\Typeable;
use Byancode\Congruent\Traits\Modelable;
use Byancode\Congruent\traits\Singleable;
use Byancode\Congruent\Traits\Statusable;
use Byancode\Congruent\Traits\Activityable;

class Signin extends Authenticatable
{
    use Modelable, Typeable, Notifiable, Singleable, Statusable, Activityable;
    
    protected $table = 'signins';
    protected $dateFormat = 'Y-m-d H:i:s.u';
    const type = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'type_id', 
        'password',
        'security', 
        'options', 
        'profile', 
        'confirmedEmail', 
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'type_id', 'security'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'security' => 'object', 
        'options' => 'object', 
        'profile' => 'object'
    ];

    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }

    public function photo()
    {
        return $this->single(Files\Photo::class);
    }
}
