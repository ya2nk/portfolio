<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('nameweb');
            $table->string('about');
            $table->string('logo');
            $table->string('icon');
            $table->text('keywords');
            $table->text('description');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('twitter');
            $table->string('linkedin');
            $table->string('github');
            $table->text('google_maps');
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
        Schema::dropIfExists('configs');
    }
}
