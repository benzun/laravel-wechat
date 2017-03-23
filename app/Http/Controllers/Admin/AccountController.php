<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ErrorHtml;
use App\Http\Business\AccountBusiness;
use App\Http\Controllers\Common\Helper;
use App\Jobs\SyncWechatUser;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\AccountRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Jobs\GetWechatAvatar;

class AccountController extends Controller
{
    /**
     * 添加公众号
     */
    public function getStore()
    {
        return view('admin.account.store');
    }

    /**
     * 添加公众号
     * @param Request $request
     * @param AccountBusiness $account_business
     */
    public function postStore(AccountRequest $request, AccountBusiness $account_business)
    {
        $store_data = $request->all();

        // 检测微信公众号 AppId AppSecret 输入是否正确
        $check_result = Helper::checkWechatAccount(array_only($store_data, [
            'app_id', 'secret'
        ]));

        if ($check_result === false) {
            return Helper::formSubmitError($store_data, 'AppId(应用ID) 或者 AppSecret(应用密钥) 填写错误！');
        }
        
        // 添加微信公众号
        $account = $account_business->store($store_data);
        if (empty($account)) {
            return Helper::formSubmitError($store_data, '添加微信公众号失败！');
        }

        // 队列处理微信头像
        $this->dispatch(new GetWechatAvatar($account));
        // 队列处理同步微信用户
        $job = (new SyncWechatUser($account));
        $this->dispatch($job);

        $redirect_url = action('Admin\AccountController@getGuide') . '?identity=' . $account->identity;

        return redirect($redirect_url);
    }

    /**
     * 更新公众号信息
     */
    public function getUpdate(Request $request, AccountBusiness $account_business)
    {
        $identity = $request->get('identity', 0);

        $info = $account_business->show($identity);
        if (empty($info)) throw new ErrorHtml('没有获取到数据');

        return view('admin.account.update', compact('info'));
    }

    /**
     * 更新公众号信息
     * @param Request $request
     * @param AccountBusiness $account_business
     */
    public function postUpdate(AccountRequest $request, AccountBusiness $account_business)
    {
        $update_data = $request->all();
        $identity = $request->get('identity',null);

        $result = $account_business->update($identity, $update_data);

        if (empty($result)) {
            return Helper::formSubmitError($update_data, '更新微信公众号失败！');
        }

        return redirect('admin');

    }

    /**
     * 微信公众号接入引导页
     * @param null $account_id
     */
    public function getGuide(Request $request, AccountBusiness $account_business)
    {
        $identity = $request->get('identity', 0);

        $info = $account_business->show($identity);
        if (empty($info)) throw new ErrorHtml('没有获取到数据');

        return view('admin.account.guide', compact('info'));
    }

    /**
     * 进入公众号平台
     * @param Request $request
     * @param AccountBusiness $account_business
     */
    public function getChange(Request $request, AccountBusiness $account_business)
    {
        $identity = $request->get('identity', 0);

        $info = $account_business->show($identity);
        if (empty($info)) throw new ErrorHtml('没有获取到数据');
 
        Session::forget('wechat_account');
        Session::put('wechat_account', $info);

        return redirect(action('Admin\WechatController@getIndex'));
    }


    /**
     * Ajax检测是否接入成功
     * @param int $account_id
     * @param AccountBusiness $account_business
     */
    public function getCheckActivate(Request $request, AccountBusiness $account_business)
    {
        $identity = $request->get('identity', 0);
        $info = $account_business->show($identity);
        $data = !empty($info) && $info['activate'] == 'yes' ? 'yes' : 'no';
        return $this->jsonFormat($data);
    }

}
