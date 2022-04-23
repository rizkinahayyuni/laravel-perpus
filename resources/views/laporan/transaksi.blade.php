@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Export Laporan Transaksi PDF</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <br>
  

  <div class="content">
    <div class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
                <br>
                @if(Auth::user()->level == 'admin')
                    <div class="card-body row">
                        <div class="col-md-4">
                            <a href="{{url('laporan/trs/pdf')}}">
                                <button type="button" class="btn btn-primary btn-block"><i class="fa fa-bars"></i> Cetak Semua Laporan Transaksi </button>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{url('laporan/trs/pdf?status=pinjam')}}">
                                <button type="button" class="btn btn-warning btn-block"><i class="fa fa-minus"></i> Cetak Laporan Transaksi Pinjam </button>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{url('laporan/trs/pdf?status=kembali')}}">
                                <button type="button" class="btn btn-success btn-block"><i class="fa fa-check"></i> Cetak Laporan Transaksi Kembali </button>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
          </div>
        </div>
    </div>
  </div>

@endsection