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
        if (isset($condition['admin_users_id']) && is_numeric($condition['admin_users_id']) && $condition['admin_users_id'] > 0){
            $builder->where('admin_users_id', $condition['admin_users_id']);
        }
        
        $builder->orderBy('id', 'ASC');

        if (isset($condition['all']) && $condition['all']){
            return $builder->get();
        }

        $page_size = isset($condition['page_size']) && is_numeric($condition['page_size']) ? abs($condition['page_size']) : 20;

        return $builder->paginate($page_size);
    }
}