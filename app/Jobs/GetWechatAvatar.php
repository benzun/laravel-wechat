<?php

namespace App\Jobs;

use App\Http\Controllers\Common\Helper;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Intervention\Image\Facades\Image;

class GetWechatAvatar extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $account = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($account)
    {
        $this->account = $account;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 微信号
        $wechat_id = $this->account->wechat_id;
        // 微信二维码地址
        $avatar_url = 'http://open.weixin.qq.com/qr/code/?username=' . $wechat_id;
        // 裁剪头像
        try {
            $img = Image::make($avatar_url);
            $path = public_path("static/admin/img/weixin/{$wechat_id}.jpg");
            $img->crop(86, 86, 172, 172)->save($path);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
}
