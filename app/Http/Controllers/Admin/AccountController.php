<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * 添加公众号
     */
    public function getCreate()
    {
        return view('admin.account.create');
    }
}
