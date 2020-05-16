@extends('layouts.app')
	@section('content')
		<div class="content-body">
			<div class="container">
				<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
					<div>
						<h4 class="mg-b-0 tx-spacing--1">Laporan Data Pagu</h4>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-4">
								<form action="{{ base_url('lap_pagu/cetak') }}" method="get" autocomplete="off">
									<div class="form-group">
										<label for="">Tanggal Awal</label>
										<input name="tgl_awal" type="text" class="form-control datepicker">
									</div>
									<div class="form-group">
										<label for="">Tanggal Akhir</label>
										<input name="tgl_akhir" type="text" class="form-control datepicker">
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Cetak</button>
									</div>
								</form>
							</div>
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
						window.location.href="{{ base_url('program/delete')}}"+'?id='+id;
					}else{
						return false;
					}
				});
			});
		</script>
	@endpush