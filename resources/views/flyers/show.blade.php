@extends('layout')

@section('content')
	<div class="row">
		<div class="col-md-4">
			<h1>{{ $flyer->street }}</h1>
			<h2>R$ {!! number_format($flyer->price) !!}</h2>

			<hr>

			<div class="description">{!! nl2br($flyer->description) !!}</div>

		</div>

		<div class="col-md-8 galery">
			@foreach ($flyer->photos->chunk(4) as $set)
				<div class="row">
					@foreach ($set as $photo)
 						<div class="col-md-3 galery_image">
 							<img src='{{ url("$photo->thumbnail_path") }}' alt="">
 						</div>
					@endforeach
				</div>
			@endforeach
		</div>
	</div>

	<hr>

	<h2>Add Your Photos:</h2>

	<form id="addPhotoForm" action="/{{ $flyer->zip }}/{{ $flyer->street }}/photos" method="post" class="dropzone">
		{{ csrf_field() }}
	</form>
@endsection


@section('scripts.footer')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>

	<script>

		//Dropzone nos da acesso ao objeto global para especificar as opções de acordo com o id da form
		Dropzone.options.addPhotoForm = {
			paramName: 'photo',
			maxFilesize: 3, // em MB
			acceptedFiles: '.jpg, .jpeg, .png, .bpm',



		}
	</script>
@endsection
