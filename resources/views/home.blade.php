@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content-header">
    </div>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$transaksi->count()}}</h3>

                <p>Transaksi</p>
              </div>
              <div class="icon">
                <i class="fas fa-inbox"></i>
              </div>
              <a href="{{ route('transaksi.index') }}" class="small-box-footer">Cek Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$transaksi->where('status', 'pinjam')->count()}}</h3>

                <p>Sedang Pinjam</p>
              </div>
              <div class="icon">
                <i class="fas fa-barcode"></i>
              </div>
              <a href="#" class="small-box-footer">Cek Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{$buku->count()}}</h3>

                <p>Buku</p>
              </div>
              <div class="icon">
                <i class="fas fa-book"></i>
              </div>
              <a href="{{ route('buku.index') }}" class="small-box-footer">Cek Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          @if(Auth::user()->level == 'admin')  
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$anggota->count()}}</h3>

              <p>Anggota</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="{{ route('anggota.index') }}" class="small-box-footer">Cek Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endif
          <!-- ./col -->
        </div>
    </div>

</div>
@endsection
