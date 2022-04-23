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

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Export Laporan Data Buku PDF</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="content">
    <div class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
                <br>
                @if(Auth::user()->level == 'admin')
                    <div class="card-body row">
                        <div class="col-md-4">
                            <a href="{{url('laporan/buku/pdf')}}">
                                <button type="button" class="btn btn-primary btn-block"><i class="fa fa-bars"></i> Cetak Pdf </button>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection