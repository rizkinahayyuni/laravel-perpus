@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

} );
</script>
@stop
@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Master Buku</h1>
      </div><!-- /.col -->
      <div class="col-sm-2"></div>
      <div>
        <form class="float-right form-inline" id="searchForm" method="get" action="{{ route('buku.index') }}" role="search">
          <div class="form-group">
              <input type="text" name="keyword" class="form-control" id="Keyword" aria-describedby="Keyword" placeholder="Cari Buku.." value="{{request()->query('keyword')}}">
          </div>
          <button type="submit" class="btn btn-primary mx-2">Cari</button>
          <a href="{{ route('buku.index') }}">
              <button type="button" class="btn btn-danger">Reset</button>
          </a>
        </form>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

@if(Auth::user()->level == 'admin')
<br>
<div class="col-lg-2">
  <a href="{{ route('buku.create') }}" class="btn btn-outline-primary btn-block"><i class="fa fa-plus"></i> Tambah Buku</a>
</div>
@endif
<br>
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
@endif

<div class="content">
  <div class="row">
    <div class="col-lg-12">
      @if (Session::has('message'))
        <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">
          {{ Session::get('message') }}
        </div>
      @endif
        <div class="card">
          <div class="card-body table-responsive p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th colspan="2">
                        Judul
                      </th>
                      <th>
                        ISBN
                      </th>
                      <th>
                        Pengarang
                      </th>
                      <th>
                        Tahun
                      </th>
                      <th>
                        Stok
                      </th>
                      <th>
                        Rak
                      </th>
                      @if(Auth::user()->level == 'admin')
                      <th>
                        Action
                      </th>
                      @endif
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($datas as $data)
                      <tr>
                        <td class="py-1">
                            @if($data->cover)
                              <img src="{{url('images/buku/'. $data->cover)}}" alt="image" style="height: 70px; width : 70px" />
                            @else
                              <img src="{{url('images/buku/default.png')}}" alt="image" style="height: 50px; width : 50px" />
                            @endif
                        </td>
                        <td>
                          <a href="{{route('buku.show', $data->id)}}"> 
                            {{$data->judul}}
                          </a>
                        </td>
                        <td> 
                          {{$data->isbn}}
                        </td>
                        <td>
                          {{$data->pengarang}}
                        </td>
                        <td>
                          {{$data->tahun_terbit}}
                        </td>
                        <td>
                          {{$data->jumlah_buku}}
                        </td>
                        <td>
                          {{$data->lokasi}}
                        </td>
                        <td>
                          @if(Auth::user()->level == 'admin')
                          <form action="{{ route('buku.destroy', $data->id) }}" class="pull-left"  method="post">
                                <div class="btn-group">
                                  <a class="dropdown-item"  href="{{route('buku.show', $data->id)}}">
                                    <button type="button" class="btn btn-info">Detail</button>
                                  </a>
                                  <a class="dropdown-item"  href="{{route('buku.edit', $data->id)}}">
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
                          @endif
                        </td>
                      </tr>
                        @endforeach
                  </tbody>
                </table>
              </div>
              {{--  {!! $datas->links() !!} --}}
          </div>
        </div>
    </div>
  </div>
</div>
@endsection