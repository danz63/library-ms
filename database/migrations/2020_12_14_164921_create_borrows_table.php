<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBorrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->tinyInteger('status');
            $table->timestamps();
        });

        DB::table('borrows')->insert([
            ['id' => '1', 'user_id' => '3', 'status' => '0', 'created_at' => '2021-01-19 22:33:26'],
            ['id' => '2', 'user_id' => '4', 'status' => '1', 'created_at' => '2021-01-19 22:48:31'],
            ['id' => '3', 'user_id' => '5', 'status' => '2', 'created_at' => '2021-01-19 23:28:03'],
            ['id' => '4', 'user_id' => '6', 'status' => '3', 'created_at' => '2021-01-19 23:31:19'],
            ['id' => '5', 'user_id' => '7', 'status' => '4', 'created_at' => '2021-01-20 00:44:37'],
            ['id' => '6', 'user_id' => '8', 'status' => '3', 'created_at' => '2021-01-12 23:52:19']
        ]);

        /*
            Status Table Peminjaman
            0 => 'belum diajukan peminjaman oleh member'
            1 => 'belum dikonfirmasi admin'
            2 => 'sudah dikonfirmasi admin (buku fisik belu diambil)'
            3 => 'buku sudah diambil (masa peminjaman)'
            4 => 'buku sudah dikembalikan'
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrows');
    }
}
