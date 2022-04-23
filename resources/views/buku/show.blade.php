@extends('layouts.app')

@section('content')

<div class="content">
    <div class="row justify-content-center">
        <section class="content">
            <div class="container-fluid">
                    <h2>Detail Buku</h2>
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
                            @if($data->cover)
                              <img src="{{url('images/buku/'. $data->cover)}}" alt="buku cover" class="img-thumbnail" width="300px" />
                            @else
                              <img src="{{url('images/buku/default.png')}}" alt="buku cover" class="img-thumbnail" width="300px" />
                            @endif
                        </div>
                        
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>JUDUL</b> <a class="float-right">{{$data->judul}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>ISBN</b> <a class="float-right">{{$data->isbn}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>PENGARANG</b> <a class="float-right">{{$data->pengarang}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>PENERBIT</b> <a class="float-right">{{$data->penerbit}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>TAHUN TERBIT</b> <a class="float-right">{{$data->tahun_terbit}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>DESKRIPSI</b> <a class="float-right">{{$data->deskripsi}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>LOKASI</b> <a class="float-right">{{$data->lokasi}}</a>
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