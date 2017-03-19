<?php

namespace App\Http\Controllers\Admin;

use App\Http\Business\AccountBusiness;
use App\Http\Controllers\Common\Helper;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AccountRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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

        $result = $account_business->store($store_data);
        if (!$result) {
            return Helper::formSubmitError($store_data, '添加微信公众号失败！');
        }

        $redirect_url = action('Admin\AccountController@getGuide') . '?account_id=' . $result->id;

        return redirect($redirect_url);
    }

    /**
     * 微信公众号接入引导页
     * @param null $account_id
     */
    public function getGuide(Request $request, AccountBusiness $account_business)
    {
        $account_id = $request->get('account_id', 0);

        $info = $account_business->show([
            'account_id'     => $account_id,
            'admin_users_id' => Helper::getAdminLoginInfo()
        ]);

        return view('admin.account.guide', compact('info'));
    }

    /**
     * 检测是否接入成功
     * @param int $account_id
     * @param AccountBusiness $account_business
     */
    public function getCheckActivate(Request $request, AccountBusiness $account_business)
    {
        $account_id = $request->get('account_id', 0);
        $account_info = $account_business->show([
            'account_id' => $account_id,
            'admin_users_id' => Helper::getAdminLoginInfo()
        ]);
        return $this->jsonFormat($account_info);
    }

}
