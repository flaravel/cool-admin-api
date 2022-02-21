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
        Schema::create('admin_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->comment('父菜单ID')->nullable();
            $table->string('name',100)->comment('菜单名称')->default('');
            $table->string('router',100)->comment('菜单地址')->default('');
            $table->string('perms')->comment('权限标识')->default('');
            $table->unsignedTinyInteger('type')->comment('类型 0：目录 1：菜单 2：按钮')->default(0);
            $table->string('icon',100)->comment('图标')->default('');
            $table->unsignedInteger('order_num')->comment('排序')->default(0);
            $table->string('view_path',200)->comment('视图地址')->default('');
            $table->unsignedTinyInteger('keep_alive')->comment('路由缓存')->default(1);
            $table->unsignedTinyInteger('is_show')->comment('是否展示')->default(1);
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
        Schema::dropIfExists('admin_menus');
    }
};
