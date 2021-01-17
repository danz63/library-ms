<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        DB::table('categories')->insert([
            ['id' => '1', 'name' => 'Web Programming', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '2', 'name' => 'Network', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '3', 'name' => 'Graphics Design', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '4', 'name' => 'Mathematics', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '5', 'name' => 'Artificial Intelligence', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '6', 'name' => 'Machine Learning', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => '7', 'name' => 'Software Engineering', 'created_at' => date('Y-m-d H:i:s')]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
