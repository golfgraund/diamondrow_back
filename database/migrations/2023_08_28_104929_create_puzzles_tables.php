<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuzzlesTables extends Migration
{
    public function up()
    {
        Schema::create('puzzles', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            // feel free to modify the name of this column, but title is supported by default (you would need to specify the name of the column Twill should consider as your "title" column in your module controller if you change it)
            $table->string('title', 200)->nullable();
            $table->text('matrix_progress')->nullable();

            $table->unsignedBigInteger('code_id');
            $table->unsignedBigInteger('customer_id');

            $table->foreign('code_id')->references('id')->on('puzzle_codes')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });

        Schema::create('puzzle_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'puzzle');
        });
    }

    public function down()
    {
        Schema::dropIfExists('puzzle_slugs');
        Schema::dropIfExists('puzzles');
    }
}
