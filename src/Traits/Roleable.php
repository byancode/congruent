<?php
namespace Byancode\Congruent\Traits;

use Byancode\Congruent\Role;

trait Roleable
{
    public function roleableClass()
    {
        return (new ReflectionClass(static::roleable ?? Role::class))->getName();
    }
    public function roles()
    {
        return $this->morphToMany($this->roleableClass(), 'roleable', 'roleables', 'role_id');
    }
    public function hasRoles(Array $roles)
    {
        return $this->roles->whereIn('name', $roles)->isNotEmpty();
    }
    public function hasRole(String $role)
    {
        return $this->roles->where('name', $role)->isNotEmpty();
    }
    public function anyRole(Array $roles)
    {
        return $this->roles->map(function($role){
            return $role->name;
        })->intersect($roles)->isNotEmpty();
    }
}