<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameReviewsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     //24. added up down functions for renaming 'attendace' to 'attendance'
    public function up()
    {
        Schema::table('reviews', function(Blueprint $table) {
            $table->renameColumn('attendace', 'attendance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function(Blueprint $table) {
            $table->renameColumn('attendance', 'attendace');
        });
    }
}
