<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['kode_transaksi', 'anggota_id', 'buku_id', 'tgl_pinjam', 'tgl_kembali', 'status'];

    public function anggota()
    {
    	return $this->belongsTo(Anggota::class);
    }

    public function buku()
    {
    	return $this->belongsTo(Buku::class);
    }
}
