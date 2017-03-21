<?php

namespace App\Jobs;

use App\Http\Controllers\Common\Helper;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;

class SyncWechatUser extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $account = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($account = null)
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
        try {
            $account_info = $this->account;
            // 实例化微信用户服务
            $userService = Helper::newWechat([
                'app_id' => $account_info->app_id,
                'secret' => $account_info->secret,
            ])->user;

            $next_open_id = null;
            // 获取用户openid列表
            while ($next_open_id !== false) {
                $wechat_openids = $userService->lists($next_open_id);
                // 获取opneid列表
                $data = $wechat_openids->data;
                // 根据openids获取微信用户信息
                $wechat_users = $userService->batchGet($data['openid']);

                // 添加用户信息
                $model = App::make('UserModel');

                array_map(function ($user) use ($account_info, $model) {
                    $user['admin_users_id'] = $account_info->admin_users_id;
                    $user['account_id']     = $account_info->id;
                    $user['tagid_list']     = json_encode($user['tagid_list']);
                    return $model->create($user);
                }, $wechat_users->user_info_list);

                $next_open_id = empty($wechat_openids->next_openid) ? false : $wechat_openids->next_openid;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }


    }
}
