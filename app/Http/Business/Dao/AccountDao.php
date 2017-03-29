<?php

namespace App\Http\Business\Dao;

use Illuminate\Support\Facades\App;

class AccountDao extends BasicDao
{
    /**
     * 获取公众号列表
     * @param array $condition
     * @param array $select_field
     * @return mixed
     */
    public function index(array $condition = [], array $select_field = ['*'])
    {
        $builder = App::make('AccountModel')->select($select_field);

        // 获取登陆用户公众号
        if (isset($condition['admin_users_id']) && is_numeric($condition['admin_users_id']) && $condition['admin_users_id'] > 0) {
            $builder->where('admin_users_id', $condition['admin_users_id']);
        }

        $builder->orderBy('id', 'ASC');

        if (isset($condition['all']) && $condition['all']) {
            return $builder->get();
        }

        $page_size = isset($condition['page_size']) && is_numeric($condition['page_size']) ? abs($condition['page_size']) : 20;

        return $builder->paginate($page_size);
    }

    /**
     * 添加微信公众号
     * @param array $store_data
     */
    public function store($store_data = [])
    {
        return App::make('AccountModel')->create($store_data);
    }

    /**
     * 获取微信公众号详情
     * @param array $condition
     */
    public function show(array $condition = [], array $select_field = ['*'])
    {
        $builder = App::make('AccountModel')->select($select_field);
        // 身份标识
        if (isset($condition['identity'])) {
            $builder->where('identity', $condition['identity']);
        }
        // 后台用户id
        if (isset($condition['admin_users_id'])) {
            $builder->where('admin_users_id', $condition['admin_users_id']);
        }

        return $builder->first();
    }

    /**
     * 更新微信公众号信息
     * @param int $account_id
     * @param array $update_data
     */
    public function update(array $condition = [], array $update_data = [])
    {
        $allow = [
            'name',
            'wechat_id',
            'original_id',
            'type',
            'activate'
        ];

        $allow_data = [];

        foreach ($update_data as $key => $value) {
            if (in_array($key, $allow) && !empty($value)) {
                $allow_data[$key] = $value;
            }
        }

        $model = App::make('AccountModel');
        
        // 身份标识
        if (isset($condition['identity'])) {
            $model->where('identity', $condition['identity']);
        }
        // 后台用户id
        if (isset($condition['admin_users_id'])) {
            $model->where('admin_users_id', $condition['admin_users_id']);
        }

        return $model->update($allow_data);
    }
}