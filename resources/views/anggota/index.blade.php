@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Master Anggota</h1>
      </div><!-- /.col -->
      <div class="col-sm-2"></div>
      <div>
        <form class="float-right form-inline" id="searchForm" method="get" action="{{ route('anggota.index') }}" role="search">
          <div class="form-group">
              <input type="text" name="keyword" class="form-control" id="Keyword" aria-describedby="Keyword" placeholder="Cari Anggota.." value="{{request()->query('keyword')}}">
          </div>
          <button type="submit" class="btn btn-primary mx-2">Cari</button>
          <a href="{{ route('anggota.index') }}">
              <button type="button" class="btn btn-danger">Reset</button>
          </a>
        </form>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- Content Wrapper. Contains page content -->
<br>
<div class="col-lg-2">
  <a href="{{ route('anggota.create') }}" class="btn btn-outline-primary btn-block"><i class="fa fa-plus"></i> Tambah Anggota</a>
</div>
<br>
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
@endif
<!-- RESPONSIVE HOVER TABLE -->
<div class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table text-nowrap">
            <thead>
              <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Prodi</th>
                <th>Jenis Kelamin</th>
                <th>Username</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($datas as $data)
                          <tr>
                            <td class="py-1">
                              {{$data->nama}}
                            </td>
                            <td> 
                              {{$data->nim}}
                            </a>
                            </td>
                            <td>
                              @if($data->prodi == 'TI')
                                Teknik Informatika
                              @else
                                Manajemen Informatika
                              @endif
                            </td>
                            <td>
                              {{$data->jk === "L" ? "Laki - Laki" : "Perempuan"}}
                            </td>
                            <td>
                              {{$data->user->username}}
                            </td>
                            <td>
                              <form action="{{ route('anggota.destroy', $data->id) }}" class="pull-left"  method="post">
                                <div class="btn-group">
                                  <a class="dropdown-item"  href="{{route('anggota.show', $data->id)}}">
                                    <button type="button" class="btn btn-info">Detail</button>
                                  </a>
                                  <a class="dropdown-item"  href="{{route('anggota.edit', $data->id)}}">
                                    <button type="button" class="btn btn-success">Edit</button>
                                  </a>
                                  <a class="dropdown-item">
                                    
                                      {{-- {{ csrf_field() }}
                                      {{ method_field('delete') }} --}}
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                        Delete
                                      </button>
                                  </a>
                                </div>
                              </form>
                            </td>
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