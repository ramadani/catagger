<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCataggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cataggers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('cataggables', function (Blueprint $table) {
            $table->integer('catagger_id', false, true);
            $table->foreign('catagger_id')->references('id')->on('cataggers');
            $table->string('catagger_type');
            $table->integer('cataggable_id', false, true);
            $table->string('cataggable_type');
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
        Schema::dropIfExists('cataggables');
        Schema::dropIfExists('cataggers');
    }
}
