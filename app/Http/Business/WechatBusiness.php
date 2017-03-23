<?php

namespace App\Http\Business;

use App\Exceptions\JsonException;
use App\Http\Controllers\Common\Helper;

class WechatBusiness extends BasicBusiness
{
    /**
     * 关注事件
     * @param null $openid
     * @param null $account_info
     */
    public function eventSubscribe($openid = null, array $account_info = null)
    {
        if (empty($openid) || empty($account_info)) {
            throw new JsonException(10000);
        }

        $user_business = app('App\Http\Business\UserBusiness');

        $user_info = $user_business->show($openid, $account_info['admin_users_id'], $account_info['id']);

        // 存在该微信用户
        if (!empty($user_info)) {
            $user_business->update($openid, $account_info['admin_users_id'], $account_info['id'], [
                'subscribe' => 1
            ]);
        }

        // 有获取微信用户信息权限
        if ($account_info['type'] == 'auth_service') {
            $wechat = Helper::newWechat([
                'app_id' => $account_info['app_id'],
                'secret' => $account_info['secret']
            ]);

            // 获取微信用户信息
            $user_info = $wechat->user->get($openid)->toArray();

            $user_business->store(array_map($user_info,[
                'admin_users_id' => $account_info['admin_users_id'],
                'account_id' => $account_info['id']
            ]));

        }

        return '欢迎关注';
    }
}