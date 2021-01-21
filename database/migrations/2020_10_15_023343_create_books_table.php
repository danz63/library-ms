<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('images');
            $table->tinyInteger('status');
            $table->timestamps();
        });
        DB::table('books')->insert([
            ['id' => '1', 'title' => 'Rekayasa perangkat lunak', 'images' => '1610987070.jpg', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'title' => 'Buku Machine Learning Tingkat Dasar Dan Lanjut', 'images' => '1610988632.jpeg', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '3', 'title' => 'Matriks & Transformasi Linear - Wikaria Gazali', 'images' => '1610989017.jpg', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '4', 'title' => 'Panduan Praktis Menguasai Vue JS', 'images' => '1611051639.jpg', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '5', 'title' => 'Konsep Dan Implementasi Pemrograman Laravel 5', 'images' => '1611051768.jpg', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '6', 'title' => 'Pembuatan Jaringan Nirkabel Mengunakan Cisco Packet Tracer', 'images' => '1611051922.jpeg', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '7', 'title' => 'Membangun Aplikasi dengan PHP, Codeigniter, dan AJAX', 'images' => '1611052056.jpg', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '8', 'title' => 'Membangun Sistem Informasi Akademik Menggunakan Framework Codeigniter', 'images' => '1611052151.jpg', 'status' => 1, 'created_at' => date('Y-m-d H:i:s')]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
