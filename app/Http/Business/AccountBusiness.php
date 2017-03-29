<?php

namespace App\Http\Business;

use App\Exceptions\ErrorHtml;
use App\Exceptions\JsonException;
use App\Http\Business\Dao\AccountDao;
use App\Http\Controllers\Common\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AccountBusiness extends BasicBusiness
{
    private $dao;

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
        return $this->dao->index($condition, $select_field);
    }

    /**
     * 添加公众号
     * @param array $store_data
     */
    public function store(array $store_data = [])
    {
        $store_data['admin_users_id'] = Helper::getAdminLoginInfo('id');
        $store_data['token']          = Helper::createToken();
        $store_data['aes_key']        = Helper::createEncodingAESKey();
        $store_data['identity']       = Helper::createToken();
        // 获取公众号认证类型
        $store_data['type'] = Helper::getWecahtType($store_data);

        return $this->dao->store($store_data);
    }

    /**
     * 获取微信公众号信息
     */
    public function show(array $condition = [], array $select_field = ['*'])
    {
        if (empty($condition)){
            throw new JsonException(10000);
        }
        return $this->dao->show($condition, $select_field);
    }

    /**
     * 更新微信公众号信息
     * @param array $update_data
     */
    public function update(array $condition = [], array $update_data = [])
    {
        if (empty($condition)){
            throw new JsonException(10000);
        }
        // 判断 secret 是否有修改
        if (isset($update_data['secret']) && substr_count($update_data['secret'], '*') > 0) {
            unset($update_data['secret']);
        }
        return $this->dao->update($condition, $update_data);
    }
}