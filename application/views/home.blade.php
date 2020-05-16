@extends('layouts.app')
@section('content')
	<div class="section-header">
		<h1>Dashboard </h1><small>&nbsp; Sistem Informasi Persediaan Barang Metode FIFO (PT INDAH KIAT pulp and paper products)</small>
	</div>
	<style>
		.white{
			color: #fff !important;
		}
	</style>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Histori Stok Barang</h5>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped">
						<tr>
							<th>Tgl Masuk</th>
							<th>Nama Barang</th>
							<th>Satuan</th>
							<th>Stok Awal</th>
							<th>Histori Stok</th>
						</tr>
						@foreach ($rows as $item)
							<tr>
								<td>{{ $item->tgl_barang_masuk }}</td>
								<td>{{ $item->nama_barang }}</td>
								<td>{{ $item->satuan }}</td>
								<td>{{ $item->jml_masuk }}</td>
								<td>{{ $item->stok_masuk }}</td>
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
		</div>
	</div>
@endsection