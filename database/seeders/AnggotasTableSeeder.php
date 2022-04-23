<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggotasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('anggota')->insert([
            [
                'id'  			=> 1,
                'user_id'  		=> 1,
                'nim'			=> 1000000945,
                'nama' 			=> 'Admin',
                'tempat_lahir'	=> 'Malang',
                'tgl_lahir'		=> '1995-01-01',
                'jk'			=> 'L',
                'prodi'			=> 'Teknik Informatika',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now()
              ],
              [
                'id'  			=> 2,
                'user_id'  		=> 2,
                'nim'			=> 1941720001,
                'nama' 			=> 'User1',
                'tempat_lahir'	=> 'Batu',
                'tgl_lahir'		=> '2000-01-01',
                'jk'			=> 'L',
                'prodi'			=> 'Manajemen Informatika',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now()
              ],
        ]);
    }
}
