@extends('layouts.app')
@section('content')
	<div class="section-header">
		<h1>Data Supplier</h1>
        @include('supplier.breadcrumb')
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Data Supplier</h4>
                    </div>
                <div></div>
                    <div class="card-body">
                        <form action="" method="POST" autocomplete="off">
                            @include('supplier.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection