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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('img_path')->nullable(); //顔写真
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('city_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->unsignedBigInteger('university_id');
            $table->foreign('university_id')->references('id')->on('schools')
            // $table->foreignId('university_id')
            // ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('teachers');
    }
};
