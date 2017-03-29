<?php

namespace App\Http\Controllers\Wechat;

use App\Exceptions\JsonException;
use App\Http\Business\UserBusiness;
use App\Http\Business\WechatBusiness;
use App\Http\Controllers\Common\Helper;
use App\Http\Business\AccountBusiness;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class WechatController extends Controller
{
    /**
     * 微信公众号服务接入处理
     * Author weixinhua
     * @param Request $request
     * @param AccountBusiness $account_business
     * @param WechatBusiness $wechat_business
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws JsonException
     * @throws \EasyWeChat\Core\Exceptions\InvalidArgumentException
     */
    public function service(Request $request, AccountBusiness $account_business, WechatBusiness $wechat_business)
    {
        $request_data = $request->only([
            'identity', 'signature', 'timestamp', 'nonce', 'echostr'
        ]);

        if (empty($request_data['identity']) || strlen($request_data['identity']) != 32) throw new JsonException(1000);

        // 获取公众号信息
        $account_info = $account_business->show([
            'identity' => $request_data['identity']
        ]);

        if (empty($account_info)) throw new JsonException(20001);

        $wechat = Helper::newWechat([
            'app_id'  => $account_info->app_id,
            'secret'  => $account_info->secret,
            'token'   => $account_info->token,
            'aes_key' => $account_info->aes_key
        ]);

        // 实例化微信服务端
        $wechat_server = $wechat->server;

        $wechat_server->setMessageHandler(function ($message) use ($account_info, $wechat_business, $wechat) {
            return $wechat_business->messageHandler($message, $wechat, $account_info);
        });

        $response = $wechat_server->serve();

        // 微信公众号配置接入请求,并更新微信公众号接入状态
        if (!empty($request_data['echostr']) && $response->getContent() == $request_data['echostr']) {
            // 更新接入状态
            $account_business->update([
                'identity' => $request_data['identity']
            ], [
                'activate' => 'yes'
            ]);
        }

        return $response;
    }
}
