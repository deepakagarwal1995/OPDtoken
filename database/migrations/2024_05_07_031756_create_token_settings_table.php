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
        Schema::create('token_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('avg_time_in_min')->nullable();
            $table->integer('curr_token')->nullable()->default('0');
            $table->tinyInteger('status')->nullable()->default('0');
            $table->date('start_from_date')->nullable();
            $table->time('start_from_time')->nullable();
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
        Schema::dropIfExists('token_settings');
    }
};
