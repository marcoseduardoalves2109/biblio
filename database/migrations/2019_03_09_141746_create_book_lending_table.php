<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookLendingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_lending', function (Blueprint $table) {
            $table->integer('book_id')->unsigned();
            $table->foreign('book_id')
                    ->references('id')
                    ->on('books');

            $table->integer('lending_id')->unsigned();
            $table->foreign('lending_id')
                    ->references('id')
                    ->on('lendings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_lending');
    }
}
