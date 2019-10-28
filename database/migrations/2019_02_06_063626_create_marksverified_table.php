<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarksverifiedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marksverified', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id');
            $table->String('facultyverified_ia');
            $table->String('facultyverified_tw');
            $table->String('facultyverified_oral');
            $table->String('hod_verified');
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
        Schema::dropIfExists('marksverified');
    }
}
