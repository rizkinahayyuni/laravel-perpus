@extends('layouts.app')

@section('content')

<div class="content">
    <div class="row justify-content-center">
        <section class="content">
            <div class="container-fluid">
                    <h2>Detail Anggota</h2>
            </div>
        </section>
    </div>
</div>

<div class="content">
    <div class="row justify-content-center">
        <div class="col-5">
            <section class="content">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if($data->user->gambar)
                              <img src="{{url('images/user/'. $data->user->gambar)}}" alt="User profile picture" class="profile-user-img img-fluid img-circle" />
                            @else
                              <img src="{{url('images/user/default.png')}}" alt="User profile picture" class="profile-user-img img-fluid img-circle" />
                            @endif
                        </div>
                        <h3 class="profile-username text-center">{{$data->nama}}</h3>
            
                        <p class="text-muted text-center">{{$data->nim}}</p><br>
                        
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Tempat Lahir</b> <a class="float-right">{{$data->tempat_lahir}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Tanggal Lahir</b> <a class="float-right">{{$data->tgl_lahir}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Jenis Kelamin</b> <a class="float-right">{{$data->jk === "L" ? "Laki - Laki" : "Perempuan"}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Program Studi</b> <a class="float-right">{{$data->prodi === "TI" ? "Teknik Informatika" : "Manajemen Informatika"}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="{{ URL::previous() }}">
                            <button type="submit" class="btn btn-danger btn-block">Kembali</button>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection