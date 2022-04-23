@section('js')

<script type="text/javascript">

$(document).ready(function() {
    $(".users").select2();
});

</script>

<script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                return false
            })
        })
</script>
@stop

@extends('layouts.app')

@section('content')

<form action="{{ route('user.update', $data->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('put') }}
    <div class="content">
        <div class="row justify-content-center">
            <section class="content">
                <div class="container-fluid">
                        <h2>Edit Data User</h2>
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
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Nama :</label>
                
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input id="name" name="name"  value="{{ $data->name }}" required type="text" class="form-control" data-mask placeholder="Masukkan Nama">
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>
        
                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label>Username :</label>
                
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-paperclip"></i></span>
                                    </div>
                                    <input id="username" name="username"  value="{{ $data->username }}" required type="text" class="form-control" data-mask placeholder="Masukkan Username">
                                    @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>Email :</label>
                
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input id="email" name="email"  value="{{ $data->email }}" required type="text" class="form-control" data-mask placeholder="Masukkan email">
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('gambar') ? ' has-error' : '' }}">
                                    <label>Foto :</label>
                                    <div>
                                        <img width="200" height="200" @if($data->gambar) src="{{ asset('images/user/'.$data->gambar) }}" @endif />
                                        <input type="file" class="uploads form-control" name="cover" style="margin-top: 20px;">
                                    </div>

                                </div>
        
                                <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                    <label>Level :</label>
                
                                    <div class="input-group">
                                        <select class="form-control select2" name="level" required="">
                                            <option value=""></option>
                                            <option value="admin" {{$data->level === "admin" ? "selected" : ""}}>Admin</option>
                                            <option value="anggota" {{$data->level === "anggota" ? "selected" : ""}}>Anggota</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <a href="{{route('user.index')}}">
                                    <button type="submit" class="btn btn-success btn-block" id="submit">Simpan</button>
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