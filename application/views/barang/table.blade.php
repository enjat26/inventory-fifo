@extends('layouts.app')
@section('content')
	<div class="section-header">
		<h1>Data Barang</h1>
        @include('barang.breadcrumb')
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tabel Barang</h4>
                        <a href="{{ base_url('barang/create') }}" class="btn btn-small btn-success"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                    <div class="card-body">
                        @if (isset($_SESSION['success']) == 'success')
						<div class="alert alert-success" role="alert">Data berhasil di{{ $_SESSION['success'] }}</div>
						@elseif (isset($_SESSION['success']) == 'error')
							<div class="alert alert-danger" role="alert">Data gagal di{{ $_SESSION['error'] }}</div>
						@endif
						<table id="datatable" class="table table-striped dataTable dtr-column collapsed">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Barang</th>
									<th>Harga</th>
									<th>Satuan</th>
									<th>No Rak</th>
									<th>Aksi </th>
								</tr>
							</thead>
							<tbody>
								@php
									$no=1;
								@endphp
								@foreach ($rows as $r)
									<tr>
										<td>{{ $no }}</td>
										<td>{{ $r->nama_barang }}</td>
										<td>{{ $r->harga }}</td>
										<td>{{ $r->satuan }}</td>
										<td>{{ $r->no_rak }}</td>
										<td width="200px">
											<a href="{{ base_url('barang/edit').'?id='.$r->id_barang }}" class="btn btn-small btn-warning"><i class="fa fa-edit"></i> Edit</a>
											<button data-delete="{{ $r->id_barang }}" class="btn-delete btn btn-small btn-danger"><i class="fa fa-trash"></i> Hapus</a>
										</td>
									</tr>
								@php
									$no++;
								@endphp
								@endforeach
							</tbody>
						</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(".btn-delete").click(function() {
                var hapus = confirm('yakin data akan dihapus?');
                var id = $(this).attr('data-delete');
                if(hapus == true){
                    window.location.href="{{ base_url('barang/delete')}}"+'?id='+id;
                }else{
                    return false;
                }
            });
        });
    </script>
@endpush