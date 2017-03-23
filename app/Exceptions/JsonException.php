<?php

namespace App\Exceptions;

use Exception;

class JsonException extends Exception
{

    private $error_code = null;
    private $data = [];
    private $error_code_list = [
        10000 => '参数错误',
        20001 => '公众号不存在',
        20002 => '没有权限获取微信用户资料',
    ];

    /**
     * 初始化
     * JsonException constructor.
     * @param string $error_code
     * @param array $data
     */
    public function __construct($error_code, array $data = [])
    {
        $this->error_code = $error_code;
        $this->data       = $data;
    }

    /**
     * 获取错误消息
     * @return array
     */
    public function getErrorMessage()
    {
        $this->error_code = isset($this->error_code_list[$this->error_code]) ? $this->error_code : 10000;

        return [
            'error_code' => $this->error_code,
            'data'       => $this->data,
            'error_msg'  => $this->error_code_list[$this->error_code]
        ];
    }

}