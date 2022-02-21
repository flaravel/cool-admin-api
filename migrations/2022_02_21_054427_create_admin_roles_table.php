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
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->comment('管理员ID')->default(0);
            $table->string('name')->comment('名称')->default('');
            $table->string('remark')->comment('备注')->default('');
            $table->string('label')->comment('角色标签')->default('');
            $table->unsignedTinyInteger('relevance')->comment('数据权限是否关联上下级')->default(1);
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
        Schema::dropIfExists('admin_roles');
    }
};
