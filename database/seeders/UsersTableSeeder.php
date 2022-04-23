<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id'  			=> 1,
                'name'  		=> 'Admin',
                'username'		=> 'admin',
                'email' 		=> 'admin@perpus.com',
                'password'		=> bcrypt('admin'),
                'gambar'		=> 'admin.png',
                'level'			=> 'admin',
                'remember_token'=> NULL,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now()
              ],
              [
                'id'  			=> 2,
                'name'  		=> 'User1',
                'username'		=> 'user1',
                'email' 		=> 'user1@perpus.com',
                'password'		=> bcrypt('user1'),
                'gambar'		=> 'user1.png',
                'level'			=> 'anggota',
                'remember_token'=> NULL,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now()
              ]
        ]);
    }
}
