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
<form method="POST" action="{{ route('storenewbook') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('put') }}

    <div class="content">
        <div class="row justify-content-center">
            <section class="content">
                <div class="container-fluid">
                        <h2>Tambah Buku Baru Pengganti Buku Hilang</h2>
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
                                        <span class="input-group-text"><i class="fas fa-paperclip"></i></span>
                                    </div>
                                    <input id="nim" name="nim"  value="{{ $data->kode_transaksi }}" required type="text" class="form-control" data-mask disabled placeholder="Kode Transaksi">
                                    @if ($errors->has('kode_transaksi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->kode_transaksi }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
                                    <label>Judul :</label>
                
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input id="judul" name="judul" value="{{ old('judul') }}" type="text" class="form-control" data-mask placeholder="Masukkan Judul">
                                    @if ($errors->has('judul'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('judul') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>
        
                                <div class="form-group{{ $errors->has('isbn') ? ' has-error' : '' }}">
                                    <label>ISBN :</label>
                
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-paperclip"></i></span>
                                    </div>
                                    <input id="isbn" name="isbn" value="{{ old('isbn') }}" type="text" class="form-control" data-mask placeholder="Masukkan ISBN">
                                    @if ($errors->has('isbn'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('isbn') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('pengarang') ? ' has-error' : '' }}">
                                    <label>PENGARANG :</label>
                
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input id="pengarang" name="pengarang" value="{{ old('pengarang') }}" type="text" class="form-control" data-mask placeholder="Masukkan Nama Pengarang">
                                        @if ($errors->has('pengarang'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pengarang') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('penerbit') ? ' has-error' : '' }}">
                                    <label>PENERBIT :</label>
                
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input id="penerbit" name="penerbit" value="{{ old('penerbit') }}" type="text" class="form-control" data-mask placeholder="Masukkan Nama Penerbit">
                                        @if ($errors->has('penerbit'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('penerbit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('tahun_terbit') ? ' has-error' : '' }}">
                                    <label>TAHUN TERBIT :</label>
                
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}" type="number" class="form-control" data-mask placeholder="Masukkan Tahun Terbit">
                                        @if ($errors->has('tahun_terbit'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tahun_terbit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('jumlah_buku') ? ' has-error' : '' }}">
                                    <label>JUMLAH BUKU :</label>
                
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input id="jumlah_buku" name="jumlah_buku" value="{{ old('jumlah_buku') }}" type="text" class="form-control" data-mask placeholder="Masukkan Jumlah Buku">
                                        @if ($errors->has('jumlah_buku'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('jumlah_buku') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
                                    <label>DESKRIPSI :</label>
                
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" type="text" class="form-control" data-mask placeholder="Masukkan Deskripsi Buku">
                                        @if ($errors->has('deskripsi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('deskripsi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group{{ $errors->has('lokasi') ? ' has-error' : '' }}">
                                    <label>LOKASI RAK BUKU :</label>
                
                                    <div class="input-group">
                                        <select class="form-control select2" name="lokasi" required="">
                                            <option value=""></option>
                                            <option value="rak1">Rak 1</option>
                                            <option value="rak2">Rak 2</option>
                                            <option value="rak3">Rak 3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
                                    <label>COVER :</label>
                                    <div>
                                        <img width="200" height="200" />
                                        <input type="file" class="uploads form-control" name="cover" style="margin-top: 20px;">
                                    </div>

                                </div>
        
                            </div>

                            <div class="card-footer">
                                <a href="{{route('transaksihilang')}}">
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