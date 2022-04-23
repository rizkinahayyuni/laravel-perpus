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
        <h1 class="m-0">Data Master User</h1>
      </div><!-- /.col -->
      <div class="col-sm-2"></div>
      <div>
        <form class="float-right form-inline" id="searchForm" method="get" action="{{ route('user.index') }}" role="search">
          <div class="form-group">
              <input type="text" name="keyword" class="form-control" id="Keyword" aria-describedby="Keyword" placeholder="Cari User.." value="{{request()->query('keyword')}}">
          </div>
          <button type="submit" class="btn btn-primary mx-2">Cari</button>
          <a href="{{ route('user.index') }}">
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
  <a href="{{ route('user.create') }}" class="btn btn-outline-primary btn-block"><i class="fa fa-plus"></i> Tambah User</a>
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
                <th colspan="2">Nama</th>
                <th>Username</th>
                <th>E-Mail</th>
                <th>level</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($datas as $data)
                          <tr>
                            <td>
                                @if($data->gambar)
                                    <img src="{{url('images/user', $data->gambar)}}" alt="image" style="height: 50px; width : 50px" />
                                @else
                                    <img src="{{url('images/user/default.png')}}" alt="image" style="height: 50px; width : 50px" />
                                @endif
                            </td>
                            <td> 
                                {{$data->name}}
                            </td>
                            <td>
                                {{$data->username}}
                            </td>
                            <td>
                                {{$data->email}}
                            </td>
                            <td>
                                {{$data->level}}
                            </td>
                            <td>
                            <form action="{{ route('user.destroy', $data->id) }}" class="pull-left"  method="post">
                                <div class="btn-group">
                                  <a class="dropdown-item"  href="{{route('user.show', $data->id)}}">
                                    <button type="button" class="btn btn-info">Detail</button>
                                  </a>
                                  <a class="dropdown-item"  href="{{route('user.edit', $data->id)}}">
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