<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_users_id')->default(0)->comment('管理帐号ID');
            $table->integer('account_id')->default(0)->comment('所属公众号账号id');
            $table->string('openid')->default('')->comment('用户的标识');
            $table->tinyInteger('subscribe')->default(0)->comment('用户是否订阅该公众号标识');
            $table->string('nickname')->default('')->comment('用户的昵称');
            $table->tinyInteger('sex')->default('0')->comment('用户的性别，值为1时是男性，值为2时是女性，值为0时是未知');
            $table->string('city')->default('')->comment('用户所在城市');
            $table->string('province')->default('')->comment('用户所在省份');
            $table->string('headimgurl')->default('')->comment('用户头像');
            $table->integer('subscribe_time')->default(0)->comment('用户关注时间');
            $table->string('remark')->default('')->comment('对粉丝备注');
            $table->integer('groupid')->default(0)->comment('用户所在的分组ID');
            $table->string('tagid_list')->default(0)->comment('用户被打上的标签ID列表');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
