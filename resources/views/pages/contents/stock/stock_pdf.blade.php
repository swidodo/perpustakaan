<!DOCTYPE html>
<html>
<head>
	<title>Laporan Stock Buku</title>
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
		<h5>Laporan Stock Buku</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Buku</th>
				<th>Jenis Buku</th>
				<th>Judul Buku</th>
				<th>Penerbit</th>
				<th>No Rak</th>
				<th>Stock</th>
				<th>Dipinjam</th>
				<th>Stock Tersedia</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp 
			@foreach($data as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->code}}</td>
				<td>{{$p->jenis_buku}}</td>
				<td>{{$p->judul_buku}}</td>
				<td>{{$p->penerbit}}</td>
				<td>{{$p->no_rak}}</td>
				<td>{{$p->stock}}</td>
				<td>{{$p->stock_out}}</td>
				<td>{{$p->stock - $p->stock_out}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>