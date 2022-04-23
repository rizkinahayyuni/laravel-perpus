@extends('layouts.app')

@section('content')

<div class="content">
    <div class="row justify-content-center">
        <section class="content">
            <div class="container-fluid">
                    <h2>Detail User</h2>
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
                            @if($data->gambar)
                              <img src="{{url('images/user/'. $data->gambar)}}" alt="User profile picture" class="profile-user-img img-fluid img-circle" />
                            @else
                              <img src="{{url('images/user/default.png')}}" alt="User profile picture" class="profile-user-img img-fluid img-circle" />
                            @endif
                        </div>
                        <h3 class="profile-username text-center">{{$data->name}}</h3>
                        
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Level</b> <a class="float-right">{{$data->level}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Username</b> <a class="float-right">{{$data->username}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>email</b> <a class="float-right">{{$data->email}}</a>
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