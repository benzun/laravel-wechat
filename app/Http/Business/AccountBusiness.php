<?php

namespace App\Http\Business;

use App\Http\Business\Dao\AccountDao;
use App\Http\Controllers\Common\Helper;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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

        // 裁剪头像
        try {
            $img = Image::make('http://open.weixin.qq.com/qr/code/?username=' . $store_data['wechat_id']);
            $img->crop(86, 86, 172, 172)->save(Helper::getWechatHeadImgPath($store_data['wechat_id']));
        } catch (\Exception $e) {
        }

        return $this->dao->store($store_data);
    }

    /**
     * 获取微信公众号信息
     */
    public function show(array $condition = [])
    {
        return $this->dao->show($condition);
    }

    /**
     * 更新微信公众号信息
     * @param array $update_data
     */
    public function update($account_id = 0, array $update_data = [])
    {
        return $this->dao->update($account_id, $update_data);
    }
}