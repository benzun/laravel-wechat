<?php

namespace App\Http\Business;

use App\Exceptions\JsonException;
use EasyWeChat\Support\Collection;

class WechatBusiness extends BasicBusiness
{
    private $message;
    private $account_info;
    private $user_business;
    private $wechat_app;

    /**
     * 初始化
     * WechatBusiness constructor.
     * @param UserBusiness $user_business
     */
    public function __construct(UserBusiness $user_business)
    {
        $this->user_business = $user_business;
    }

    /**
     * 消息业务处理
     * @param null $message
     * @param array $account_info
     */
    public function messageHandler(Collection $message, $wechat_app, $account_info)
    {
        $this->message = $message;
        $this->account_info = $account_info;
        $this->wechat_app = $wechat_app;

        switch ($message->MsgType) {
            case 'event':
                switch ($message->Event) {
                    case 'subscribe':
                        return self::eventSubscribe();
                        break;
                    case 'unsubscribe':
                        return self::eventUnsubscribe();
                        break;
                }
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
            // ... 其它消息
            default:
                return '收到其它消息';
                break;
        }
    }

    /**
     * 关注公众号
     * Author weixinhua
     * @return string
     * @throws JsonException
     */
    public function eventSubscribe()
    {
        //  获取微信用户信息
        $user_info = $this->user_business->show([
            'openid'         => $this->message->FromUserName,
            'admin_users_id' => $this->account_info->admin_users_id,
            'account_id'     => $this->account_info->id,
        ]);

        // 判断该微信用户是否存在
        if (empty($user_info) && $this->account_info->type == 'auth_service') {
            // 获取微信用户信息
            $user_info = $this->wechat_app->user->get($this->message->FromUserName)->toArray();
        }

        // 更新微信用户关注状态
        if (!empty($user_info) && $user_info->subscribe == 0) {
            $this->user_business->update([
                'openid'         => $this->message->FromUserName,
                'admin_users_id' => $this->account_info->admin_users_id,
                'account_id'     => $this->account_info->id,
            ], [
                'subscribe' => 1
            ]);
        }

        return '欢迎关注';
    }

    /**
     * 取消关注公众号
     * Author weixinhua
     * @throws JsonException
     */
    public function eventUnsubscribe()
    {
        $this->user_business->update([
            'openid'         => $this->message->FromUserName,
            'admin_users_id' => $this->account_info->admin_users_id,
            'account_id'     => $this->account_info->id,
        ], [
            'subscribe' => 0
        ]);
    }

}