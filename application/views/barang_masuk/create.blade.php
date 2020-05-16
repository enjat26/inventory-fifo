@extends('layouts.app')
@section('content')
	<div class="section-header">
		<h1>Data Barang</h1>
        @include('barang_masuk.breadcrumb')
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Barang Masuk</h4>
                    </div>
                <div></div>
                    <div class="card-body">
                        {{-- <form action="" method="POST" autocomplete="off"> --}}
                            @include('barang_masuk.form',['mode' => 'create'])
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection