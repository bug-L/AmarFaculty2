<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInitialsToProfessors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //101. created up and down function
    public function up()
    {
        Schema::table('professors', function (Blueprint $table) {
            $table->string('initials', 5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professors', function (Blueprint $table) {
            $table->dropColumn('initials');
        });
    }
}
