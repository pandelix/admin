<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_logs', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->unsignedInteger('admin_user_id');
            $table->string('admin_name', 100);
            $table->string('admin_username', 100);
            $table->ipAddress('ip');
            $table->string('route', 200);
            $table->string('method', 10);
            $table->string('url', 1000);
            $table->json('input');
            $table->string('status_code', 10);
            $table->timestamp('created_at');

            $table->unique('uuid');
            $table->index('admin_user_id');
            $table->index('admin_name');
            $table->index('admin_username');
            $table->index('ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_logs');
    }
}
