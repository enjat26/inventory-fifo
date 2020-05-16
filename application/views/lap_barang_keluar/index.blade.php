@extends('layouts.app')
	@section('content')
	<div class="section-header">
		<h1>Cetak Laporan Barang Masuk</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-4">
								<form action="{{ base_url('lap_barang_keluar/cetak') }}" method="get" autocomplete="off">
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
          		$(".datepicker").click(function() {
					autoclose:true
				});
			});
		</script>
	@endpush