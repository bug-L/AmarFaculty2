<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_universities', function (Blueprint $table) {
            $table->bigIncrements('id');
            //16. set fields
            $table->integer('department_id')->unsigned();
            $table->integer('university_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('university_id')->references('id')->on('universties');
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
        Schema::dropIfExists('department_universities');
    }
}
