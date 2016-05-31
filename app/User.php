<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustPermissionTrait;
use Zizaco\Entrust\Traits\EntrustRoleTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    // ajotue les methodes de la librarie Entrust
    use EntrustUserTrait;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function chats()
    {
        return $this->hasMany('App\Chat');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
