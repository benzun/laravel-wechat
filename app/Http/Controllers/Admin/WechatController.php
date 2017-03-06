<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    /**
     * 添加微信公众号
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreateAccount()
    {
        return view('admin.account.create');
    }
}
