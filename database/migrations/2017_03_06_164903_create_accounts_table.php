<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_users_id')->default(0)->comment('管理帐号ID');
            $table->string('name', 60)->default('')->comment('公众号名称');
            $table->string('original_id',20)->default('')->comment('公众号原始ID');
            $table->string('wechat_account',20)->default('')->comment('微信号');
            $table->enum('account_type',['subscribe','service'])->default('subscribe')->comment('公众号类型');
            $table->string('app_id',50)->default('')->comment('AppId');
            $table->string('app_secret',50)->default('')->comment('AppSecret');
            $table->string('token',50)->default('')->comment('加密token');
            $table->string('aes_key',43)->default('')->comment('AES加密key');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('accounts');
    }
}
