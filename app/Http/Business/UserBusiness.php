<?php

namespace App\Http\Business;

use App\Exceptions\JsonException;
use App\Http\Business\Dao\UserDao;

class UserBusiness extends BasicBusiness
{
    private $dao;

    /**
     * 初始化
     * UserBusiness constructor.
     * @param UserDao $dao
     */
    public function __construct(UserDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * 获取微信用户列表
     * @param array $condition
     */
    public function index(array $condition = [])
    {
        return $this->dao->index($condition);
    }

    /**
     * 添加微信用户
     * Author weixinhua
     * @param array $store_data
     * @return mixed
     */
    public function store(array $store_data = [])
    {
        if (isset($store_data['tagid_list']) && is_array($store_data['tagid_list'])) {
            $store_data['tagid_list'] = json_encode($store_data['tagid_list']);
        }

        return $this->dao->store($store_data);
    }

    /**
     * 更新微信用户信息
     * Author weixinhua
     * @param array $condition
     * @param array $update_data
     * @return mixed
     * @throws JsonException
     */
    public function update(array $condition = [], array $update_data = [])
    {
        if (empty($condition)) {
            throw new JsonException(10000);
        }

        return $this->dao->update($condition, $update_data);
    }


    /**
     * 获取微信用户详情
     * Author weixinhua
     * @param array $condition
     * @return mixed
     * @throws JsonException
     */
    public function show(array $condition = [], array $select_field = ['*'])
    {
        if (empty($condition)) {
            throw new JsonException(10000);
        }
        return $this->dao->show($condition, $select_field);
    }
}