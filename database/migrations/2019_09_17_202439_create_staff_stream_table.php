<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffStreamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_stream', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stream_id')->unsigned();
            $table->integer('staff_id')->unsigned();
            $table->foreign('stream_id')->references('id')->on('streams')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('staffs')->onDelete('cascade');
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
        Schema::dropIfExists('staff_stream');
    }
}
