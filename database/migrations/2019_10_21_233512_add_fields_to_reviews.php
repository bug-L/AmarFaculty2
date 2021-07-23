<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //118. added up and down functions
        Schema::table('reviews', function (Blueprint $table) {
            //
            Schema::table('reviews', function (Blueprint $table) {
                $table->boolean('offensive');
                $table->string('user_ip', 20);
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            //
            $table->dropColumn(['offensive', 'ip']);
        });
    }
}
