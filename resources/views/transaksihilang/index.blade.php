@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transaksi Buku Hilang</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <br>

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
                                        <form action="{{ route('terlambat', [$data->id]) }}" method="POST" enctype="multipart/form-data">
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
                                        <div class="btn-group-vertical">
                                            <a href="{{ route('createnewbook', $data->id) }}">
                                                <button class="btn btn-info btn-sm"> Ganti Buku Baru</button>
                                            </a>
                                            <form action="{{ route('updategantibuku', $data->id) }}" method="post" enctype="multipart/form-data">
                                              {{ csrf_field() }}
                                              {{ method_field('put') }}
                                                <button class="btn btn-secondary btn-sm" > Ganti Status Kembali</button>
                                            </form>
                                          </form>
                                        </div>
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