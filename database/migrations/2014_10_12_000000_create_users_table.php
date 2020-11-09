<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('image');
            $table->string('password');
            $table->integer('access_id');
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'username' => 'root',
                'name' => 'Super User',
                'address' => 'Indonesia',
                'image' => 'root.png',
                'password' => password_hash('secretpassword', PASSWORD_DEFAULT),
                'access_id' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'member',
                'address' => 'Indonesia',
                'name' => 'Member Library',
                'image' => 'member.png',
                'password' => password_hash('secretpassword', PASSWORD_DEFAULT),
                'access_id' => 2,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
