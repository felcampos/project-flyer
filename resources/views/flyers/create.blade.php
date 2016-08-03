@extends('layout')

@section('content')

<div class="row">

	<div class="col-md-6 col-md-offset-3">
		<h1>Selling Your Home?</h1>
		<hr>
	</div>
</div>


<div class="row">
	<form action="/flyers" method="post" enctype="multipart/form-data" class="col-md-6 col-md-offset-3">

		@include('flyers.form')

		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif


	</form>
</div>

@endsection
