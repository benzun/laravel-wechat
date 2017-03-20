<?php

namespace App\Exceptions;

use Exception;

class ErrorHtml extends Exception
{
    private $error_msg = null;

    /**
     * 初始化
     * ErrorHtml constructor.
     * @param string $error_msg
     */
    public function __construct($error_msg)
    {
        $this->error_msg = $error_msg;
    }

    /**
     * 获取错误消息
     * @return null|string
     */
    public function getErrorMessage()
    {
        return $this->error_msg;
    }
}