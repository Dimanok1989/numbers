<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class CreateStatVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stat_visits', function (Blueprint $table) {
            $table->id();
            $table->string('method', 50)->nullable();
            $table->string('ip', 50)->nullable();
            $table->string('url', 500)->nullable();
            $table->integer('status_code')->nullable();
            $table->string('referer', 500)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->json('data')->default(new Expression('(JSON_ARRAY())'));
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stat_visits');
    }
}
