<?php

namespace App\Http\Business\Dao;

use Illuminate\Support\Facades\App;

class UserDao extends BasicDao
{

    public function store(array $store_data = [])
    {
        return App::make('UserModel')->create($store_data);
    }

    /**
     * 获取微信用户详情
     * @param null $openid
     * @param null $admin_user_id
     * @param null $account_id
     */
    public function show($openid = null, $admin_user_id = null, $account_id = null, array $select_field = ['*'])
    {
        $builder = App::make('UserModel')->select($select_field);
        $builder->where('openid', $openid);
        $builder->where('admin_user_id', $admin_user_id);
        $builder->where('account_id', $account_id);
        return $builder->first();
    }
}