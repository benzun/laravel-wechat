<?php

namespace App\Http\Controllers\Admin;

use App\Http\Business\AccountBusiness;
use App\Http\Controllers\Common\Helper;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class IndexController extends Controller
{
    /**
     * 获取登陆用户公众号列表
     * @param AccountBusiness $account_business
     */
    public function index(AccountBusiness $account_business)
    {   
        $list = $account_business->index([
            'all'            => true,
            'admin_users_id' => Helper::getAdminLoginInfo()
        ]);

        return view('admin.index.index', compact('list'));
    }
}
