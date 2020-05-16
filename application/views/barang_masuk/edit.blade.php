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
                        <h4>Form Edit Barang Masuk</h4>
                    </div>
                    <div class="card-body">
                        @include('barang_masuk.form',['mode' => 'edit'])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection