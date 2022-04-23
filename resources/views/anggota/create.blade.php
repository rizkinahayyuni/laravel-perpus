@section('js')

<script type="text/javascript">

$(document).ready(function() {
    $(".users").select2();
});

</script>
@stop

@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('anggota.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="content">
        <div class="row justify-content-center">
            <section class="content">
                <div class="container-fluid">
                        <h2>Tambah Data Anggota</h2>
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
                                <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                    <label>Nama :</label>
                
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input id="nama" name="nama" value="{{ old('nama') }}" type="text" class="form-control" data-mask placeholder="Masukkan Nama">
                                    @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>
        
                                <div class="form-group{{ $errors->has('nim') ? ' has-error' : '' }}">
                                    <label>NIM :</label>
                
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-paperclip"></i></span>
                                    </div>
                                    <input id="nim" name="nim" value="{{ old('nim') }}" type="text" class="form-control" data-mask placeholder="Masukkan NIM">
                                    @if ($errors->has('nim'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nim') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
                                    <label>Tempat Lahir :</label>
                
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" type="text" class="form-control" data-mask placeholder="Masukkan Kota Lahir">
                                        @if ($errors->has('tempat_lahir'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('tgl_lahir') ? ' has-error' : '' }}">
                                    <label>Tanggal Lahir:</label>
                
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" type="date" class="form-control" data-mask placeholder="yyyy-mm-dd">
                                        @if ($errors->has('tgl_lahir'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tgl_lahir') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                    <label>Jenis Kelamin :</label>
                
                                    <div class="input-group">
                                        <select class="form-control select2" name="jk" required="">
                                            <option value=""></option>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="form-group{{ $errors->has('prodi') ? ' has-error' : '' }}">
                                    <label>Program Studi :</label>
                
                                    <div class="input-group">
                                    <select class="form-control select2" name="prodi" required="">
                                        <option value=""></option>
                                        <option value="TI">D-4 Teknik Informatika</option>
                                        <option value="MI">D-3 Manajemen Informatika</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                                    <label>User Login :</label>
                
                                    <div class="input-group">
                                    <select class="form-control select2" name="user_id" required="">
                                        <option value="">(Cari User)</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('anggota.index')}}">
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
@endsection