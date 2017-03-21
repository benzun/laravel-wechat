<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'admin_users_id',
        'account_id',
        'openid',
        'subscribe',
        'nickname',
        'sex',
        'city',
        'province',
        'headimgurl',
        'subscribe_time',
        'remark',
        'groupid',
        'tagid_list',
    ];
}
