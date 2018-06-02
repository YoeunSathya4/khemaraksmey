@extends ($route.'.main')
@section ('section-title', 'Create New Location')
@section ('section-css')
	<link href="{{ asset ('public/cp/css/plugin/fileinput/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset ('public/cp/css/plugin/fileinput/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
	<!-- some CSS styling changes and overrides -->
	<style>
		.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
		    margin: 0;
		    padding: 0;
		    border: none;
		    box-shadow: none;
		    text-align: center;
		}
		.kv-avatar .file-input {
		    display: table-cell;
		    max-width: 220px;
		}
	</style>
@endsection

@section ('imageuploadjs')
    <script type="text/javascript" src="{{ asset ('public/cp/js/plugin/fileinput/fileinput.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset ('public/cp/js/plugin/fileinput/theme.js') }}" type="text/javascript"></script>
@endsection

@section ('section-js')
	
@endsection

@section ('section-content')
	<div class="container-fluid">
		@include('cp.layouts.error')

		@php ($name = "")
		@php ($price = "")
		@php ($estimate_time = "")
       
       	@if (Session::has('invalidData'))
            @php ($invalidData = Session::get('invalidData'))
            @php ($name = $invalidData['name'])
            @php ($price = $invalidData['price'])
            @php ($estimate_time = $invalidData['estimate_time'])
            
       	@endif
		<form id="form" action="{{ route($route.'.store') }}" name="form" method="POST"  enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="name">Name</label>
				<div class="col-sm-10">
					<input 	id="name"
							name="name"
						   	value = "{{$name}}"
						   	type="text"
						   	placeholder = "Enter name."
						   	class="form-control"
						   	data-validation="[L>=1, L<=200]"
							data-validation-message="$ must be between 6 and 18 characters. No special characters allowed." />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="price">Price</label>
				<div class="col-sm-10">
					<input 	id="price"
							name="price"
						   	value = "{{$price}}"
						   	type="text"
						   	placeholder = "Eg. 10$"
						   	class="form-control"
						   	data-validation="[L>=1, L<=200]"
							data-validation-message="$ must be between 1 and 200 characters. No special characters allowed." />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="price">Estimate Time</label>
				<div class="col-sm-10">
					<input 	id="estimate_time"
							name="estimate_time"
						   	value = "{{$estimate_time}}"
						   	type="text"
						   	placeholder = "Eg. 10am-10:30"
						   	class="form-control"
						   	data-validation="[L>=1, L<=200]"
							data-validation-message="$ must be between 1 and 200 characters. No special characters allowed." />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label"></label>
				<div class="col-sm-10">
					
					<button type="submit" class="btn btn-success"> <fa class="fa fa-plus"></i> Create</button>
				</div>
			</div>
		</form>
	</div>

@endsection