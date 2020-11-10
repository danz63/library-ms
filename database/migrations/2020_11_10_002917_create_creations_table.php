<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // Table Relations Between Book And Writer
    public function up()
    {
        Schema::create('creations', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id');
            $table->integer('writer_id');
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
        Schema::dropIfExists('creations');
    }
}
