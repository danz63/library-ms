<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDetailBorrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_borrows', function (Blueprint $table) {
            $table->id();
            $table->integer('borrow_id');
            $table->integer('book_id');
            $table->timestamps();
        });

        DB::table('detail_borrows')->insert([
            ['id' => '1', 'borrow_id' => '1', 'book_id' => '1', 'created_at' => '2021-01-19 22:33:26'],
            ['id' => '6', 'borrow_id' => '1', 'book_id' => '2', 'created_at' => '2021-01-19 22:47:30'],
            ['id' => '7', 'borrow_id' => '2', 'book_id' => '7', 'created_at' => '2021-01-19 22:48:31'],
            ['id' => '8', 'borrow_id' => '2', 'book_id' => '8', 'created_at' => '2021-01-19 22:48:34'],
            ['id' => '9', 'borrow_id' => '3', 'book_id' => '1', 'created_at' => '2021-01-19 23:28:03'],
            ['id' => '10', 'borrow_id' => '3', 'book_id' => '2', 'created_at' => '2021-01-19 23:28:06'],
            ['id' => '11', 'borrow_id' => '4', 'book_id' => '8', 'created_at' => '2021-01-19 23:31:19'],
            ['id' => '12', 'borrow_id' => '4', 'book_id' => '6', 'created_at' => '2021-01-19 23:31:22'],
            ['id' => '13', 'borrow_id' => '5', 'book_id' => '6', 'created_at' => '2021-01-19 23:51:52'],
            ['id' => '14', 'borrow_id' => '5', 'book_id' => '7', 'created_at' => '2021-01-19 23:51:54'],
            ['id' => '15', 'borrow_id' => '6', 'book_id' => '4', 'created_at' => '2021-01-19 23:52:19'],
            ['id' => '16', 'borrow_id' => '6', 'book_id' => '3', 'created_at' => '2021-01-19 23:52:22']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_borrows');
    }
}
