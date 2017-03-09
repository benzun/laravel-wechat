<?php

namespace App\Http\Controllers\Admin;

use App\Http\Business\AccountBusiness;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * 获取登陆用户公众号列表
     * @param AccountBusiness $account_business
     */
    public function index(AccountBusiness $account_business)
    {
        $account_list = $account_business->index([
            'admin_users_id' => Auth::user()->id
        ]);

        return view('admin.index.index', compact('account_list'));
    }
}
