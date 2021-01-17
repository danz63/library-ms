<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        DB::table('publishers')->insert([
            ['id' => '1', 'name' => 'Informatika Bandung', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'name' => 'Elex Media Komputindo', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '3', 'name' => 'Andi Publisher', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '4', 'name' => 'Maxikom', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '5', 'name' => 'Gava Media', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '6', 'name' => 'Gagas Media', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '7', 'name' => 'Graha Ilmu', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '8', 'name' => 'Erlangga', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '9', 'name' => 'Skripta', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '10', 'name' => 'Mitra Wacana Media', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '11', 'name' => 'Salemba Infotek', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '12', 'name' => 'Lokomedia', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '13', 'name' => 'Gramedia', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '14', 'name' => 'Langit Inspirasi', 'created_at' => date('Y-m-d H:i:s')]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publishers');
    }
}
