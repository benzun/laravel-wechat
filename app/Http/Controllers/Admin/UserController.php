<?php

namespace App\Http\Controllers\Admin;

use App\Http\Business\UserBusiness;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * 获取微信用户列表
     * @param Request $request
     * @param UserBusiness $user_business
     */
    public function getIndex(Request $request, UserBusiness $user_business)
    {
        $list = $user_business->index([
            'admin_users_id' => session('wechat_account.admin_users_id'),
            'account_id'     => session('wechat_account.id'),
        ]);

        return view('admin.user.index', compact('list'));
    }
}
