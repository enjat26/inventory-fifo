@extends('layouts.app')
@section('content')
	<div class="section-header">
		<h1>Data Satuan</h1>
        @include('satuan.breadcrumb')
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Data Satuan</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @include('satuan.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection