<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // Table Realations Between Book And Publisher
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id');
            $table->integer('publisher_id');
            $table->string('year');
            $table->timestamps();
        });
        DB::table('publications')->insert([
            ['id' => '1', 'book_id' => '1', 'publisher_id' => '1', 'year' => '2018', 'created_at' => '2021-01-18 23:24:31'],
            ['id' => '2', 'book_id' => '2', 'publisher_id' => '1', 'year' => '2018', 'created_at' => '2021-01-18 23:50:33'],
            ['id' => '3', 'book_id' => '3', 'publisher_id' => '7', 'year' => '2017', 'created_at' => '2021-01-18 23:56:57'],
            ['id' => '4', 'book_id' => '4', 'publisher_id' => '12', 'year' => '2018', 'created_at' => '2021-01-19 17:20:39'],
            ['id' => '5', 'book_id' => '5', 'publisher_id' => '12', 'year' => '2018', 'created_at' => '2021-01-19 17:22:48'],
            ['id' => '6', 'book_id' => '6', 'publisher_id' => '7', 'year' => '2017', 'created_at' => '2021-01-19 17:25:22'],
            ['id' => '7', 'book_id' => '7', 'publisher_id' => '2', 'year' => '2018', 'created_at' => '2021-01-19 17:27:36'],
            ['id' => '8', 'book_id' => '8', 'publisher_id' => '14', 'year' => '2018', 'created_at' => '2021-01-19 17:29:12']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications');
    }
}
