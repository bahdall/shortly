<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('link_id')->nullable(false);
            $table->unsignedBigInteger('token_id')->nullable(false);
            $table->unsignedBigInteger('user_agent_id')->nullable(true);
            $table->unsignedBigInteger('user_ip_id')->nullable(true);
            $table->unsignedBigInteger('referrer_id')->nullable(true);
            $table->timestamps();

            $table->foreign('link_id')
                ->references('id')
                ->on('links')
                ->onDelete('cascade');

            $table->foreign('token_id')
                ->references('id')
                ->on('tokens')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
