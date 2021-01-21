<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // Table Relations Between Book And Bookshelfs
    public function up()
    {
        Schema::create('storages', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id');
            $table->integer('bookshelfs_id');
            $table->timestamps();
        });
        DB::table('storages')->insert([
            ['id' => '1', 'book_id' => '1', 'bookshelfs_id' => '1', 'created_at' => '2021-01-18 23:24:30'],
            ['id' => '2', 'book_id' => '2', 'bookshelfs_id' => '2', 'created_at' => '2021-01-18 23:50:32'],
            ['id' => '3', 'book_id' => '3', 'bookshelfs_id' => '2', 'created_at' => '2021-01-18 23:56:57'],
            ['id' => '4', 'book_id' => '4', 'bookshelfs_id' => '1', 'created_at' => '2021-01-19 17:20:39'],
            ['id' => '5', 'book_id' => '5', 'bookshelfs_id' => '1', 'created_at' => '2021-01-19 17:22:48'],
            ['id' => '6', 'book_id' => '6', 'bookshelfs_id' => '3', 'created_at' => '2021-01-19 17:25:22'],
            ['id' => '7', 'book_id' => '7', 'bookshelfs_id' => '1', 'created_at' => '2021-01-19 17:27:36'],
            ['id' => '8', 'book_id' => '8', 'bookshelfs_id' => '1', 'created_at' => '2021-01-19 17:29:11']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storages');
    }
}
