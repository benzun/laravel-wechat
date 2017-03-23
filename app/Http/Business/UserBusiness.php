<?php

namespace App\Http\Business;

use App\Http\Business\Dao\UserDao;

class UserBusiness extends BasicBusiness
{
    public function __construct(UserDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * 添加微信用户
     * @param array $store_data
     */
    public function store(array $store_data = [])
    {
        return $this->dao->store($store_data);
    }

    /**
     * 获取微信用户详情
     * @param null $opneid
     * @param null $admin_user_id
     * @param null $account_id
     */
    public function show($openid = null, $admin_user_id = null, $account_id = null)
    {
        if (empty($openid) || empty($admin_user_id) || empty($account_id)){
            return false;
        }

        return $this->dao->show($openid, $admin_user_id, $account_id);
    }
}