<?php

namespace App\Http\Business;

use App\Exceptions\JsonException;
use App\Http\Business\Dao\UserDao;

class UserBusiness extends BasicBusiness
{
    private $dao;

    /**
     * UserBusiness constructor.
     * @param UserDao $dao
     */
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
        if (isset($store_data['tagid_list'])){
            $store_data['tagid_list'] = json_encode($store_data['tagid_list']);
        }

        return $this->dao->store($store_data);
    }

    /**
     * 更新微信用户信息
     * @param null $openid
     * @param null $admin_users_id
     * @param null $account_id
     */
    public function update($openid = null, $admin_users_id = null, $account_id = null, array $update_data = [])
    {
        if (empty($openid) || empty($admin_users_id) || empty($account_id) || empty($update_data)){
            throw new JsonException(10000);
        }

        return $this->dao->update($openid, $admin_users_id, $account_id, $update_data);
    }


    /**
     * 获取微信用户详情
     * @param null $opneid
     * @param null $admin_user_id
     * @param null $account_id
     */
    public function show($openid = null, $admin_users_id = null, $account_id = null)
    {
        if (empty($openid) || empty($admin_users_id) || empty($account_id)){
            return false;
        }

        return $this->dao->show($openid, $admin_users_id, $account_id);
    }
}