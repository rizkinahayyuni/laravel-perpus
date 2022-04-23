<!DOCTYPE html>
<html>
<head>
	<title>Laporan Transaksi PDF</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Transaksi PDF</h5>
	</center>
    <br>
    <br>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>Kode</th>
				<th>Buku</th>
				<th>Peminjam</th>
				<th>Tgl Pinjam</th>
				<th>Tgl Kembali</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
      @foreach($datas as $data)
        <tr>
          <td>{{$data->kode_transaksi}}</td>
          <td>{{$data->buku->judul}}</td>
          <td>{{$data->anggota->nama}}</td>
          <td>{{date('d/m/y', strtotime($data->tgl_pinjam))}}</td>
          <td>{{date('d/m/y', strtotime($data->tgl_kembali))}}</td>
          <td>
			@php($date_facturation = \Carbon\Carbon::parse($data->tgl_kembali))
			@if ($date_facturation->isPast())
				Terlambat
            @elseif($data->status == 'pinjam')
                Pinjam
            @elseif($data->status == 'hilang')
                Hilang
            @else
                Kembali
            @endif
          </td>
        </tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>
