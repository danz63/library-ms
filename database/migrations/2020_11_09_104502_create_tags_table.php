<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // Table Relations Between books and category
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id');
            $table->integer('category_id');
            $table->timestamps();
        });
        DB::table('tags')->insert([
            ['id' => '1', 'book_id' => '1', 'category_id' => '7', 'created_at' => '2021-01-18 23:24:31'],
            ['id' => '2', 'book_id' => '3', 'category_id' => '4', 'created_at' => '2021-01-18 23:56:57'],
            ['id' => '3', 'book_id' => '2', 'category_id' => '4', 'created_at' => '2021-01-19 17:02:50'],
            ['id' => '4', 'book_id' => '2', 'category_id' => '5', 'created_at' => '2021-01-19 17:02:50'],
            ['id' => '5', 'book_id' => '2', 'category_id' => '6', 'created_at' => '2021-01-19 17:02:50'],
            ['id' => '6', 'book_id' => '4', 'category_id' => '1', 'created_at' => '2021-01-19 17:20:39'],
            ['id' => '7', 'book_id' => '4', 'category_id' => '7', 'created_at' => '2021-01-19 17:20:39'],
            ['id' => '8', 'book_id' => '5', 'category_id' => '7', 'created_at' => '2021-01-19 17:22:48'],
            ['id' => '9', 'book_id' => '5', 'category_id' => '1', 'created_at' => '2021-01-19 17:22:48'],
            ['id' => '10', 'book_id' => '6', 'category_id' => '2', 'created_at' => '2021-01-19 17:25:22'],
            ['id' => '11', 'book_id' => '7', 'category_id' => '7', 'created_at' => '2021-01-19 17:27:36'],
            ['id' => '12', 'book_id' => '7', 'category_id' => '1', 'created_at' => '2021-01-19 17:27:36'],
            ['id' => '13', 'book_id' => '8', 'category_id' => '7', 'created_at' => '2021-01-19 17:29:12'],
            ['id' => '14', 'book_id' => '8', 'category_id' => '1', 'created_at' => '2021-01-19 17:29:12']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
