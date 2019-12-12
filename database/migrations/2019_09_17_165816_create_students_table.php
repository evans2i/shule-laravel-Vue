<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('parent_name');
            $table->string('slug');
            $table->string('parent_work')->nullable();
            $table->string('birth_date')->nullable();
            $table->enum('status', ['active', 'passive'])->default('active');
            $table->string('date_registered')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('stream_id')->unsigned()->nullable();
            $table->integer('entered_by_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('stream_id')->references('id')->on('streams')->onDelete('restrict');
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
        Schema::dropIfExists('students');
    }
}
