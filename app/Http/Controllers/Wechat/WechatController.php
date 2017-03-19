<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Common\Helper;
use Exception;
use App\Http\Business\AccountBusiness;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WechatController extends Controller
{
    public function service(Request $request, AccountBusiness $account_business)
    {
        $request_data = $request->only([
            'identity', 'signature', 'timestamp', 'nonce', 'echostr'
        ]);

        if (empty($request_data['identity']) || strlen($request_data['identity'])!= 32) throw new Exception('参数错误');

        // 获取公众号信息
        $account_info = $account_business->show([
            'identity' => $request_data['identity']
        ]);

        if (empty($account_info)) throw new Exception('公众号不存在');

        $wechat = Helper::newWechat([
            'app_id'  => $account_info->app_id,
            'secret'  => $account_info->secret,
            'token'   => $account_info->token,
            'aes_key' => $account_info->aes_key
        ]);

        // 实例化微信服务端
        $wechat_server = $wechat->server;

        $wechat_server->setMessageHandler(function ($message) {
            switch ($message->MsgType) {
                case 'event':
                    switch ($message->Event) {
                        // 关注事件
                        case 'subscribe':
                            break;
                        // 取消关注事件
                        case 'unsubscribe':
                            break;
                    }
                    return '收到事件消息';
                    break;
                case 'text':
                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                default:
                    return '收到其它消息';
                    break;
            }
        });

        $response = $wechat_server->serve();

        // 微信公众号配置接入请求,并更新微信公众号接入状态
        if ($response->getContent() == $request_data['echostr']) {
            $account_business->update($account_info->id, [
                'activate' => 'yes'
            ]);
        }

        return $response;
    }

}
