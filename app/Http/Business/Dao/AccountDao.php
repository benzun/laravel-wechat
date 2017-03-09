<?php

namespace App\Http\Business\Dao;


use Illuminate\Support\Facades\App;

class AccountDao extends BasicDao
{
    public function index(array $condition = [], array $select_field = ['*'])
    {
        $builder = App::make('AccountModel')->select($select_field);
        // 条件
        $builder->where('admin_users_id', $condition['admin_users_id']);
        
        $builder->orderBy('id', 'ASC');

        if (isset($condition['all']) && $condition['all']){
            return $builder->get();
        }

        $page_size = isset($condition['page_size']) && is_numeric($condition['page_size']) ? $condition['page_size'] : 20;
        return $builder->paginate($page_size);
    }
}