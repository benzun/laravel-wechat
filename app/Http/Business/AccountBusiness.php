<?php

namespace App\Http\Business;

use App\Http\Business\Dao\AccountDao;

class AccountBusiness extends BasicBusiness
{
    public function __construct(AccountDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * 获取公众号列表
     * @param array $condition
     * @param array $select_field
     */
    public function index(array $condition = [], array $select_field = ['*'])
    {
        $this->dao->index($condition, $select_field);
    }
}