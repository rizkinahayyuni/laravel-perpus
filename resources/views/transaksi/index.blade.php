@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transaksi</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <br>
    @if(Auth::user()->level == 'admin')
    <div class="col-lg-2">
      <a href="{{ route('transaksi.create') }}" class="btn btn-outline-primary btn-block"><i class="fa fa-plus"></i> Tambah Transaksi</a>
    </div>
    <br>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table text-nowrap">
                  <thead>
                    <tr>
                      <th>Kode Transaksi</th>
                      <th>Nama Anggota</th>
                      <th>Nama Buku</th>
                      <th>Tanggal Pinjam</th>
                      <th>Tanggal Kembali</th>
                      <th>Status</th>
                      @if(Auth::user()->level == 'admin')
                      <th>Action</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datas as $data)
                              <tr>
                                  <td class="py-1">
                                    {{$data->kode_transaksi}}
                                  </td>
                                  <td> 
                                    {{$data->anggota->nama}}
                                  </td>
                                  <td>
                                    {{$data->buku->judul}}
                                  </td>
                                  <td>
                                    {{date('d/m/y', strtotime($data->tgl_pinjam))}}
                                  </td>
                                  <td>
                                    {{date('d/m/y', strtotime($data->tgl_kembali))}}
                                  </td>
                                  <td>
                                    @php($date_facturation = \Carbon\Carbon::parse($data->tgl_kembali))
                                    @if ($date_facturation->isPast())
                                        <form action="{{ route('terlambat', [$data->id]) }}" method="post" enctype="multipart/form-data">
                                          {{ csrf_field() }}
                                          {{ method_field('put') }}
                                        </form>
                                        <label class="btn btn-block btn-outline-warning btn-xs">Terlambat</label>
                                    @elseif($data->status == 'pinjam')
                                        <label class="btn btn-block btn-outline-secondary btn-xs">Pinjam</label>
                                    @elseif($data->status == 'hilang')
                                        <label class="btn btn-block btn-outline-danger btn-xs">Hilang</label>
                                    @else
                                        <label class="btn btn-block btn-outline-success btn-xs">Kembali</label>
                                    @endif
                                  </td>
                                  @if(Auth::user()->level == 'admin')
                                  <td>
                                    <div class="btn-group">
                                      @if($data->status == 'pinjam')
                                        <div class="btn-group-vertical">
                                          <form action="{{ route('transaksi.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('put') }}
                                            <button class="btn btn-success btn-sm" onclick="return confirm('Anda yakin data ini sudah kembali?')"> Sudah Kembali</button>
                                          </form>
                                          <form action="{{ route('bukuhilang', [$data->id]) }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('put') }}
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah buku yang dipinjam hilang?')"> Buku Hilang</button>
                                          </form>
                                        </div>
                                      @endif
                                    </div>
                                  </td>
                                  @endif
                              </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>

@endsection