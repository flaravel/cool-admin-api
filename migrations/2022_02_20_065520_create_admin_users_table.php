<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('department_id')->comment('部门ID')->default(0);
            $table->string('name', 30)->default('')->comment('姓名');
            $table->string('username', 30)->default('')->comment('用户名');
            $table->string('password', 150)->default('')->comment('密码');
            $table->string('avatar')->default('')->default('')->comment('头像');
            $table->string('email', 20)->default('')->comment('邮箱');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:禁用 1：启用');
            $table->string('nick_name', 50)->default('')->comment('昵称');
            $table->char('phone', 11)->default('')->comment('手机号');
            $table->string('remark')->default('')->comment('备注');
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
        Schema::dropIfExists('admin_users');
    }
};
