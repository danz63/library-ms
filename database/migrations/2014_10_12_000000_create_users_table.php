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
            ['username' => 'root', 'name' => 'Super User', 'address' => 'Indonesia', 'image' => 'root.png', 'password' => password_hash('secretpassword', PASSWORD_DEFAULT), 'access_id' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['username' => 'member', 'address' => 'Indonesia', 'name' => 'Member Library', 'image' => 'member.png', 'password' => password_hash('secretpassword', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => date('Y-m-d H:i:s')],
            ['username' => 'hiki', 'name' => 'Hikigaya Hachiman', 'address' => 'Jepun', 'image' => 'member.png', 'password' => password_hash('kazuma', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-21 09:48:48'],
            ['username' => 'kazuma', 'name' => 'Satou Kazuma', 'address' => 'Isekai', 'image' => 'member.png', 'password' => password_hash('hiki', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2021-01-12 03:23:53'],
            ['username' => 'mjeaycock0', 'name' => 'Monty Jeaycock', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('mjeaycock0', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-13 03:48:44'],
            ['username' => 'bhurle1', 'name' => 'Bevan Hurle', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('bhurle1', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-14 01:03:42'],
            ['username' => 'rmorrison2', 'name' => 'Rollo Morrison', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('rmorrison2', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2021-01-05 11:28:57'],
            ['username' => 'trawsen3', 'name' => 'Tome Rawsen', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('trawsen3', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-09 15:46:39'],
            ['username' => 'mheintze4', 'name' => 'Mellie Heintze', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('mheintze4', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2021-01-05 01:16:55'],
            ['username' => 'vsacco5', 'name' => 'Vevay Sacco', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('vsacco5', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-22 01:17:04'],
            ['username' => 'mpantry6', 'name' => 'Margette Pantry', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('mpantry6', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-23 07:29:12'],
            ['username' => 'bpollicatt7', 'name' => 'Bevon Pollicatt', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('bpollicatt7', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-24 12:12:55'],
            ['username' => 'rcartan8', 'name' => 'Rosabelle Cartan', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('rcartan8', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-20 05:56:51'],
            ['username' => 'vwildes9', 'name' => 'Vernen Wildes', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('vwildes9', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-23 22:09:51'],
            ['username' => 'kthurstancea', 'name' => 'Korey Thurstance', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('kthurstancea', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2021-01-02 04:54:32'],
            ['username' => 'lkitteringhamb', 'name' => 'Leilah Kitteringham', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('lkitteringhamb', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-13 09:12:09'],
            ['username' => 'mmonksfieldc', 'name' => 'Maye Monksfield', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('mmonksfieldc', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-04 23:40:02'],
            ['username' => 'scharerd', 'name' => 'Spence Charer', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('scharerd', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-13 06:09:08'],
            ['username' => 'rmcgrirle', 'name' => 'Rudolfo McGrirl', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('rmcgrirle', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2021-01-10 05:35:56'],
            ['username' => 'lmaxworthyf', 'name' => 'Lindsey Maxworthy', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('lmaxworthyf', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-25 15:28:47'],
            ['username' => 'tslowcockg', 'name' => 'Tobe Slowcock', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('tslowcockg', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-16 03:09:35'],
            ['username' => 'khickissonh', 'name' => 'Katharine Hickisson', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('khickissonh', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2020-12-03 23:29:50'],
            ['username' => 'chefferi', 'name' => 'Celka Heffer', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('chefferi', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2021-01-01 20:08:38'],
            ['username' => 'rgoingj', 'name' => 'Reid Going', 'address' => 'Indonesia', 'image' => 'member.png', 'password' => password_hash('rgoingj', PASSWORD_DEFAULT), 'access_id' => 2, 'created_at' => '2021-01-04 13:37:47']
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
