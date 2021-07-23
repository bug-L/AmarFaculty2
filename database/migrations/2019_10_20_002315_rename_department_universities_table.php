<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameDepartmentUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //111. Added up and down function.
    public function up()
    {
        //113. comment out up and down functions
        Schema::rename('department_universities', 'department_university');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::rename('department_university', 'department_universities');
    }
}
