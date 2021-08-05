<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queries', function (Blueprint $table) {
            //columns
            $table->bigIncrements('id');
            $table->string('query');
            $table->integer('university_id')->unsigned();
            $table->integer('match_count'); //number of professors who matched query
            $table->string('user_ip');
            $table->dateTime('created_at');

            //foreign key reference
            $table->foreign('university_id')->references('id')->on('universities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queries');
    }
}
