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
        Schema::create('tests_done', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->string('user_name');
            $table->integer('wpm');
            $table->integer('mistakes');
            $table->integer('missed');
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
        Schema::dropIfExists('tests_done');
    }
};
