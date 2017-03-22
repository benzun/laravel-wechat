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
        $wechat = self::newWechat(array_only($parameter,[
            'app_id', 'secret'
        ]));

        try {
            $wechat->access_token->getToken(true);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * 获取公众号认证类型
     * @param array $parameter
     */
    public static function getWecahtType(array $parameter = [])
    {
        $wechat = self::newWechat(array_only($parameter,[
            'app_id', 'secret'
        ]));

        // 判断是否有获取用户权限
        $is_get_user = false;
        try {
            $wechat->user->lists();
            $is_get_user = true;
        } catch (\Exception $e) {

        }
        // 具有获取用户权限，必须是通过微信认证
        if ($is_get_user === true) {
            return 'auth_service';
        }

        // 判断获取菜单权限
        $is_get_menu = false;
        try {
            $wechat->menu->all();
            $is_get_menu = true;
        } catch (\Exception $e) {

        }

        // 没有获取用户权限，有获取菜单权限，是认证订阅号,否则是订阅号
        if ($is_get_user === false && $is_get_menu === true) {
            return 'auth_subscribe';
        } else {
            return 'subscribe';
        }
    }

    /**
     * 获取后台登陆用户信息
     * @param string $field
     */
    public static function getAdminLoginInfo($field = 'id')
    {
        $admin_user = Auth::user();
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
        $wechat_config = array_merge(config('wechat'), $parameter);
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