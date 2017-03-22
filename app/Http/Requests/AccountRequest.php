<?php

namespace App\Http\Requests;

use App\Http\Controllers\Common\Helper;
use App\Http\Requests\Request;

class AccountRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required',
            'wechat_id'   => 'required',
            'original_id' => 'required',
            'app_id'      => 'sometimes|required|unique:accounts,app_id,null,id,admin_users_id,' . Helper::getAdminLoginInfo(),
            'secret'      => 'required',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'        => '请填写公众号名称',
            'wechat_id.required'   => '请填写微信号',
            'original_id.required' => '请填写公众号原始ID',
            'app_id.required'      => '请填写AppId(应用ID)',
            'app_id.unique'        => '公众号不可重复添加',
            'secret.required'      => '请填写AppSecret(应用密钥)'
        ];
    }
}
