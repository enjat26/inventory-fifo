@extends('layouts.app')
@section('content')
	<div class="section-header">
		<h1>Data Rak</h1>
        @include('rak.breadcrumb')
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit Data Rak</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @include('rak.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection