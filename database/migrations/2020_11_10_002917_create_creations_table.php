<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::table('creations')->insert([
            ['id' => '1', 'book_id' => '1', 'writer_id' => '2', 'created_at' => '2021-01-18 23:24:31'],
            ['id' => '2', 'book_id' => '2', 'writer_id' => '7', 'created_at' => '2021-01-18 23:50:33'],
            ['id' => '3', 'book_id' => '3', 'writer_id' => '5', 'created_at' => '2021-01-18 23:56:57'],
            ['id' => '4', 'book_id' => '4', 'writer_id' => '6', 'created_at' => '2021-01-19 17:20:39'],
            ['id' => '5', 'book_id' => '5', 'writer_id' => '4', 'created_at' => '2021-01-19 17:22:48'],
            ['id' => '6', 'book_id' => '6', 'writer_id' => '8', 'created_at' => '2021-01-19 17:25:22'],
            ['id' => '7', 'book_id' => '7', 'writer_id' => '1', 'created_at' => '2021-01-19 17:27:36'],
            ['id' => '8', 'book_id' => '8', 'writer_id' => '3', 'created_at' => '2021-01-19 17:29:12']
        ]);
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
