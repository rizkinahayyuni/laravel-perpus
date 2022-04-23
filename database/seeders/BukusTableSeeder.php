<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buku')->insert([
            [
                'id'  			=> 1,
                'judul'  		=> 'Machine Learning Tingkat Dasar dan Lanjut',
                'isbn'			=> '9786026232786',
                'pengarang' 	=> 'Suyanto',
                'penerbit'		=> 'PT. Informatika',
                'tahun_terbit'	=> 2018,
                'jumlah_buku'	=> 5,
                'deskripsi'		=> 'Buku mengambarkan holistik dan simpel mengenai konsep dasar machine learning',
                'lokasi'		=> 'rak1',
                'cover'			=> 'buku1.jpg',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now()
              ],
              [
                'id'  			=> 2,
                'judul'  		=> 'ANDROID Pemrograman Aplikasi Mobile Berbasis Android',
                'isbn'			=> '9786026232939',
                'pengarang' 	=> 'Nazruddin Safaat H',
                'penerbit'		=> 'PT. Restu Guru',
                'tahun_terbit'	=> 2019,
                'jumlah_buku'	=> 9,
                'deskripsi'		=> 'Buku untuk Orang Yang Berminat Menjadi Developer Atau Pengembang Aplikasi Berbasis android',
                'lokasi'		=> 'rak3',
                'cover'			=> 'buku2.jpg',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now()
              ],
              [
                'id'  			=> 3,
                'judul'  		=> 'Framework Laravel 6',
                'isbn'			=> '9786237156048',
                'pengarang' 	=> 'Anton Subagia',
                'penerbit'		=> 'CV. Asfa Media',
                'tahun_terbit'	=> 2020,
                'jumlah_buku'	=> 8,
                'deskripsi'		=> 'Buku Pertama Belajar Framework Laravel untuk Pemula',
                'lokasi'		=> 'rak2',
                'cover'			=> 'buku3.jpg',
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now()
              ],
        ]);
    }
}
