<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Models\Assigned\Role as AssignedRole;

class User extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'department_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullnameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function role() {
        return $this->hasOneThrough(
            Role::class,
            AssignedRole::class,
            'entity_id', // Foreign key on users table...
            'id', // Foreign key on history table...
            'id', // Local key on suppliers table...
            'role_id' // Local key on users table...
        )->where('entity_type', 'App\\Models\\User');
    }

    public function scopeFilterRole($query, $role)
    {
        if(!$role) {
            return $query;
        }
        return $query->whereHas('roles', function($query) use($role) {
            return $query->where('roles.name', $role);
        });
    }

    public function isAdmin(): Bool
    {
        return $this->isA('admin');
    }
}
