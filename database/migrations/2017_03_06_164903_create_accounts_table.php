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
            $table->integer('admin_users_id')->default(0)->unsigned()->comment('管理帐号ID');
            $table->string('identity')->default('')->unique()->comment('身份标识');
            $table->string('name')->default('')->comment('名称');
            $table->string('original_id')->default('')->comment('原始ID');
            $table->string('wechat_id')->default('')->comment('微信号');
            $table->enum('type', ['subscribe', 'service', 'auth_subscribe', 'auth_service'])->default('subscribe')->comment('类型');
            $table->string('app_id')->default('')->comment('应用ID');
            $table->string('secret')->default('')->comment('应用密钥');
            $table->string('token')->default('')->comment('token令牌');
            $table->string('aes_key')->default('')->comment('消息加解密密钥EncodingAESKey');
            $table->enum('activate', ['no', 'yes'])->default('no')->comment('是否在微信公众号服务器配置接入成功');
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
