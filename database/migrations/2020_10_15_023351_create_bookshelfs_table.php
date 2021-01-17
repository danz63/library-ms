<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBookshelfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookshelfs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        DB::table('bookshelfs')->insert([
            ['id' => '1', 'name' => 'A001', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'name' => 'A002', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '3', 'name' => 'A003', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '4', 'name' => 'A004', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '5', 'name' => 'A005', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '6', 'name' => 'A006', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '7', 'name' => 'A007', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '8', 'name' => 'A008', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '9', 'name' => 'A009', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '10', 'name' => 'A010', 'created_at' => date('Y-m-d H:i:s')]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookshelfs');
    }
}
