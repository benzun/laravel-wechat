<?php

namespace App\Http\Controllers\Common;

use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class Helper
{
    /**
     * 检测微信公众号 AppID,AppSecret是否正确
     * @param array $parameter
     */
    public static function checkWechatAccount(array $parameter = [])
    {
        $parameter = array_only($parameter, [
            'app_id',
            'secret'
        ]);

        $wechat = new Application($parameter);

        try {
            $wechat->access_token->getToken(true);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * 获取后台登陆用户信息
     * @param string $field
     */
    public static function getAdminLoginInfo($field = 'id')
    {
        $admin_user = Auth::user()->toArray();
        return isset($admin_user[$field]) ? $admin_user[$field] : $admin_user['id'];
    }

    /**
     * 生成微信公众号Token令牌
     */
    public static function createToken()
    {
        return md5(uniqid(md5(microtime(true)), true));
    }

    /**
     * 生成微信公众号EncodingAESKey(消息加解密密钥)
     */
    public static function createEncodingAESKey($length = 43)
    {
        $string = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        shuffle($string);
        return implode('', array_slice($string, 0, $length));
    }

    /**
     * 表单提交错误重定向上一页
     * @param array $with_input
     * @param string $with_errors
     * @return $this
     */
    public static function formSubmitError(array $with_input = [], $with_errors = '')
    {
        return redirect()->back()
            ->withInput($with_input)
            ->withErrors([
                'failed' => $with_errors,
            ]);
    }

    /**
     * 实例化Wechat对象
     * @param array $parameter
     * @return Application
     */
    public static function newWechat(array $parameter = [])
    {
        $wechat_config = array_merge(config('wechat'),$parameter);
        return new Application($wechat_config);
    }

    /**
     * 返回本地微信头像路径
     * @param $wechat_id
     */
    public static function getWechatHeadImgPath($wechat_id)
    {
        return "static/admin/img/weixin/{$wechat_id}.jpg";
    }

}