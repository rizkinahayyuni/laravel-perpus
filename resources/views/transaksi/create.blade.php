@section('js')
 <script type="text/javascript">
   $(document).on('click', '.pilih', function (e) {
                document.getElementById("buku_judul").value = $(this).attr('data-buku_judul');
                document.getElementById("buku_id").value = $(this).attr('data-buku_id');
                $('#modalbuku').modal('hide');
                $('.modal-backdrop').remove();
            });

            $(document).on('click', '.pilih_anggota', function (e) {
                document.getElementById("anggota_id").value = $(this).attr('data-anggota_id');
                document.getElementById("anggota_nama").value = $(this).attr('data-anggota_nama');
                $('#modalanggota').modal('hide');
                $('.modal-backdrop').remove();
            });
          
             $(function () {
                $("#lookup, #lookup2").dataTable();
            });

        </script>

@stop
@section('css')

@stop
@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('transaksi.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="content">
        <div class="row justify-content-center">
            <section class="content">
                <div class="container-fluid">
                        <h2>Tambah Data Transaksi</h2>
                </div>
            </section>
        </div>
    </div>

    <div class="content">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-7">
                    <section class="content">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="form-group{{ $errors->has('kode_transaksi') ? ' has-error' : '' }}">
                                    <label>Kode Transaksi :</label>
                
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input id="kode_transaksi" name="kode_transaksi" readonly value="{{ $kode }}" type="text" class="form-control" data-mask placeholder="Masukkan Kode Transaksi">
                                    @if ($errors->has('kode_transaksi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_transaksi') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>
        
                                <div class="form-group{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
                                    <label>Tanggal Pinjam :</label>
                
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input id="tgl_pinjam" name="tgl_pinjam" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" type="date" class="form-control" data-mask placeholder="Masukkan Tanggal Transaksi">
                                    @if ($errors->has('tgl_pinjam'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl_pinjam') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
                                    <label>Tanggal Kembali :</label>
                
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input id="tgl_kembali" name="tgl_kembali" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(5)->toDateString()))}}" type="date" class="form-control" data-mask placeholder="Masukkan Tanggal Kembali">
                                        @if ($errors->has('tgl_kembali'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tgl_kembali') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('buku_id') ? ' has-error' : '' }}">
                                    <label for="buku_id">Buku :</label>
                
                                    <div class="input-group">
                                        <input id="buku_judul" type="text" class="form-control" readonly="" required>
                                        <input id="buku_id" type="hidden" name="buku_id" value="{{ old('buku_id') }}" required readonly="">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalbuku">
                                                <b>Cari Buku</b> <span class="fa fa-search">
                                            </button>
                                        </span>
                                    </div>
                                    @if ($errors->has('buku_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('buku_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
        
                                <div class="form-group{{ $errors->has('anggota_id') ? ' has-error' : '' }}">
                                    <label>Anggota :</label>
                
                                    <div class="input-group">
                                        <input id="anggota_nama" type="text" class="form-control" readonly="" required>
                                        <input id="anggota_id" type="hidden" name="anggota_id" value="{{ old('anggota_id') }}" required readonly="">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-warning btn-secondary" data-toggle="modal" data-target="#modalanggota"><b>Cari Anggota</b> <span class="fa fa-search"></span></button>
                                        </span>
                                    </div>
                                        @if ($errors->has('anggota_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('anggota_id') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('transaksi.index')}}">
                                    <button type="submit" class="btn btn-success btn-block" id="submit">Tambah</button>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- /.modal -->

<div class="modal fade" id="modalbuku" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cari Buku</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table id="lookup" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>ISBN</th>
                        <th>Pengarang</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bukus as $data)
                    <tr class="pilih" data-buku_id="<?php echo $data->id; ?>" data-buku_judul="<?php echo $data->judul; ?>" >
                        <td>@if($data->cover)
                            <img src="{{url('images/buku/'. $data->cover)}}" alt="image" style="margin-right: 10px;height: 50px; width : 50px" />
                          @else
                            <img src="{{url('images/buku/default.png')}}" alt="image" style="margin-right: 10px;height: 50px; width : 50px" />
                          @endif
                            {{$data->judul}}</td>
                        <td>{{$data->isbn}}</td>
                        <td>{{$data->pengarang}}</td>
                        <td>{{$data->tahun_terbit}}</td>
                        <td>{{$data->jumlah_buku}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

<!-- /.modal -->

<div class="modal fade" id="modalanggota" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cari Anggota</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table id="lookup" class="table table-bordered table-hover table-striped">
                <thead>
            <tr>
              <th>
                Nama
              </th>
              <th>
                NIM
              </th>
              <th>
                Prodi
              </th>
              <th>
                Jenis Kelamin
              </th>
            </tr>
          </thead>
                <tbody>
                    @foreach($anggotas as $data)
                    <tr class="pilih_anggota" data-anggota_id="<?php echo $data->id; ?>" data-anggota_nama="<?php echo $data->nama; ?>" >
                        <td class="py-1">
              @if($data->user->gambar)
                <img src="{{url('images/user', $data->user->gambar)}}" alt="image" style="margin-right: 10px;height: 50px; width : 50px" />
              @else
                <img src="{{url('images/user/default.png')}}" alt="image" style="margin-right: 10px;height: 50px; width : 50px" />
              @endif

                {{$data->nama}}
              </td>
              <td>
                {{$data->nim}}
              </td>

              <td>
              @if($data->prodi == 'TI')
                Teknik Informatika
              @elseif($data->prodi == 'SI')
                Sistem Informasi
              @else
                Kesehatan Masyarakat
              @endif
              </td>
              <td>
                {{$data->jk === "L" ? "Laki - Laki" : "Perempuan"}}
              </td>
            </tr>
                    @endforeach
                </tbody>
            </table>  
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  
@endsection