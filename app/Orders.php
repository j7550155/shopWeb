<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $table='orders';

    protected $promaryKey='id';

    protected $fillable=[
        'user_id',
        'products',
        'total_price',
        'status',
    ];

    public function user()
    {
        return $this->hasOne('App\UsersAnn','id','user_id');
    }
}
