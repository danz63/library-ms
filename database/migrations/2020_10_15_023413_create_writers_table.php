<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateWritersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('writers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        DB::table('writers')->insert([
            ['id' => '1', 'name' => 'Sandi Febriatna Ramadhan dan Uus Usmawan', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'name' => 'Rosa A. S dan M.Shalahudin', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '3', 'name' => 'Badiyanto dan Yosef Muria', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '4', 'name' => 'Awan Pribadi Basuki', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '5', 'name' => 'Wikaria Ghazali', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '6', 'name' => 'Lutfi Gani', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '7', 'name' => 'Suyanto', 'created_at' => date('Y-m-d H:i:s')]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('writers');
    }
}
