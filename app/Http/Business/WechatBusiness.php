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

        \Log::info($account_info);

        $user_business = app('App\Http\Business\UserBusiness');

        $user_info = $user_business->show($openid, $account_info['admin_users_id'], $account_info['id']);

        // 存在该微信用户
        if (!empty($user_info)) {
            $user_business->update($openid, $account_info['admin_users_id'], $account_info['id'], [
                'subscribe' => 1
            ]);
        }

        $wechat = Helper::newWechat([
            'app_id' => $account_info['app_id'],
            'secret' => $account_info['secret']
        ]);

        // 获取微信用户信息
        $user_info  = $wechat->user->get($openid)->toArray();
        \Log::info($user_info);
        $user_info['admin_user_id'] = $account_info['admin_user_id'];
        $user_info['account_id']    = $account_info['id'];
        \Log::info($user_info);
        $result  = $user_business->store($user_info);
        \Log::info($result);
    }
}