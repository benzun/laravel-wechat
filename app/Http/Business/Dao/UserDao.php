<?php

namespace App\Http\Business\Dao;

use Illuminate\Support\Facades\App;

class UserDao extends BasicDao
{
    /**
     * 添加微信用户
     * @param array $store_data
     * @return mixed
     */
    public function store(array $store_data = [])
    {
        return App::make('UserModel')->create($store_data);
    }

    /**
     * 更新微信用户
     * @param null $openid
     * @param null $admin_users_id
     * @param null $account_id
     * @param array $update_data
     */
    public function update($openid = null, $admin_users_id = null, $account_id = null, array $update_data = [])
    {
        $allow = [
            'subscribe',
            'nickname',
            'sex',
            'city',
            'province',
            'headimgurl',
            'remark',
            'groupid',
            'tagid_list',
        ];

        $allow_update_data = [];

        foreach ($update_data as $key => $value) {
            if (in_array($key, $allow)) {
                $allow_update_data[$key] = $value;
            }
        }

        return App::make('UserModel')
            ->where('openid', $openid)
            ->where('admin_users_id', $admin_users_id)
            ->where('account_id', $account_id)
            ->update($allow_update_data);

    }


    /**
     * 获取微信用户详情
     * @param null $openid
     * @param null $admin_user_id
     * @param null $account_id
     */
    public function show($openid = null, $admin_users_id = null, $account_id = null, array $select_field = ['*'])
    {
        $builder = App::make('UserModel')->select($select_field);
        $builder->where('openid', $openid);
        $builder->where('admin_users_id', $admin_users_id);
        $builder->where('account_id', $account_id);
        return $builder->first();
    }
}