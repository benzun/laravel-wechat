<?php

namespace App\Http\Business\Dao;

use Illuminate\Support\Facades\App;

class UserDao extends BasicDao
{
    /**
     * 获取微信用户列表
     * @param array $condition
     */
    public function index(array $condition = [], array $select_field = ['*'])
    {
        $builder = App::make('UserModel')->select($select_field);

        // 登陆后台用户
        if (isset($condition['admin_users_id'])) {
            $builder->where('admin_users_id', $condition['admin_users_id']);
        }

        // 所属公众号
        if (isset($condition['account_id'])) {
            $builder->where('account_id', $condition['account_id']);
        }

        $page_size = isset($condition['page_size']) && is_numeric($condition['page_size']) ? abs($condition['page_size']) : 20;

        return $builder->paginate($page_size);

    }

    /**
     * account_id
     * Author weixinhua
     * @param array $store_data
     * @return mixed
     */
    public function store(array $store_data = [])
    {
        return App::make('UserModel')->create($store_data);
    }

    /**
     * 更新微信用户
     * Author weixinhua
     * @param array $condition
     * @param array $update_data
     * @return mixed
     */
    public function update(array $condition = [], array $update_data = [])
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

        $builder = App::make('UserModel');
        // 微信用户 openid
        if (isset($condition['openid'])) {
            $builder->where('openid', $condition['openid']);
        }
        // 微信用户所属后台用户
        if (isset($condition['admin_users_id'])) {
            $builder->where('admin_users_id', $condition['admin_users_id']);
        }
        // 微信用户所属公众号
        if (isset($condition['account_id'])) {
            $builder->where('account_id', $condition['account_id']);
        }

        return $builder->update($allow_update_data);
    }


    /**
     * 获取微信用户详情
     * Author weixinhua
     * @param array $condition
     * @param array $select_field
     * @return mixed
     */
    public function show(array $condition = [], array $select_field = ['*'])
    {
        $builder = App::make('UserModel')->select($select_field);
        // 微信用户 openid
        if (isset($condition['openid'])) {
            $builder->where('openid', $condition['openid']);
        }
        // 微信用户所属后台用户
        if (isset($condition['admin_users_id'])) {
            $builder->where('admin_users_id', $condition['admin_users_id']);
        }
        // 微信用户所属公众号
        if (isset($condition['account_id'])) {
            $builder->where('account_id', $condition['account_id']);
        }

        return $builder->first();
    }
}