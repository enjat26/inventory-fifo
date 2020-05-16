@extends('layouts.app')
@section('content')
	<div class="section-header">
		<h1>Data Customer</h1>
        @include('customer.breadcrumb')
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Data Customer</h4>
                    </div>
                <div></div>
                    <div class="card-body">
                        <form action="" method="POST" autocomplete="off">
                            @include('customer.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection