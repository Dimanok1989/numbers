<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_codes', function (Blueprint $table) {
            $table->id();
            $table->string('country', 3)->nullable();
            $table->string('code', 3)->unique();
            $table->string('region_name', 255);
            $table->string('comment', 255)->nullable();
            $table->timestamps();

            $table->index(['country', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region_codes');
    }
}
