<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersAnn extends Model
{
    //
    protected $table='users_ann';

    protected $promaryKey='id';

    protected $fillable=[
        'email',
        'password',
        'name',
        'admin',
        'active',
    ];

    public function orders()
    {
        return $this->hasMany('App\Orders','user_id','id');
    }

}
