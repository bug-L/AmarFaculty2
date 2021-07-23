<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToProfessors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //43. UP AND DOWN methods. these fields are added. 
    public function up()
    {
        Schema::table('professors', function (Blueprint $table) {
            $table->boolean('approved');
            $table->dateTime('deleted_at')->nullable();
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
            $table->dropColumn('approved');
            $table->dropColumn('deleted_at');
        });
    }
}
