<?php

use App\Models\Staff;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable(); // Pro. Dr. Miss, Mr, Mrs
            $table->string('position')->default(Staff::SUPPORTIVE);
            $table->string('slug')->nullable();
            $table->string('qualification');
            $table->date('employed_date')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('entered_by_id')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('staffs');
    }
}
