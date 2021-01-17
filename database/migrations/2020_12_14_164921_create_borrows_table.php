<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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

        /*
            Status Table Peminjaman
            0 => 'belum diajukan peminjaman oleh member'
            1 => 'belum dikonfirmasi admin'
            2 => 'sudah dikonfirmasi admin (buku fisik belu diambil)'
            3 => 'buku sudah diambil (masa peminjaman)'
            4 => 'masa peminjaman habis'
            5 => 'buku sudah dikembalikan'
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
