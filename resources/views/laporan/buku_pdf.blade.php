<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Buku PDF</title>
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
		<h5>Laporan Data Buku PDF</h5>
	</center>
    <br>
    <br>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>Judul</th>
				<th>ISBN</th>
				<th>Pengarang</th>
				<th>Penerbit</th>
				<th>Tahun</th>
				<th>Stok</th>
				<th>Rak</th>
			</tr>
		</thead>
		<tbody>
      @foreach($datas as $data)
        <tr>
          <td>{{$data->judul}}</td>
          <td>{{$data->isbn}}</td>
          <td>{{$data->pengarang}}</td>
          <td>{{$data->penerbit}}</td>
          <td>{{$data->tahun_terbit}}</td>
          <td>{{$data->jumlah_buku}}</td>
          <td>{{$data->lokasi}}</td>
        </tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>
