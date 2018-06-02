@extends ($route.'.main')
@section ('section-title', 'Create New Announcement')
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
	<script>
		
		var btnCust = ''; 
		$("#image").fileinput({
		    overwriteInitial: true,
		    maxFileSize: 1500,
		    showClose: false,
		    showCaption: false,
		    showBrowse: false,
		    browseOnZoneClick: true,
		    removeLabel: '',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancel or reset changes',
		    elErrorContainer: '#kv-avatar-errors-2',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="http://via.placeholder.com/420x420" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 870x429 with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});

		
	</script>
@endsection

@section ('section-content')
	<div class="container-fluid">
		@include('cp.layouts.error')

		@php ($en_title = "")
		@php ($kh_title = "")
		@php ($en_description = "")
		@php ($kh_description = "")
       
       	@if (Session::has('invalidData'))
            @php ($invalidData = Session::get('invalidData'))
            @php ($en_title = $invalidData['en_title'])
            @php ($kh_title = $invalidData['kh_title'])
            @php ($en_description = $invalidData['en_description'])
            @php ($kh_description = $invalidData['kh_description'])
            
       	@endif
		<form id="form" action="{{ route($route.'.store') }}" name="form" method="POST"  enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_title">Title (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_title"
							name="kh_title"
						   	value = "{{$kh_title}}"
						   	type="text"
						   	placeholder = "Enter Khmer title."
						   	class="form-control"
						   	data-validation="[L>=1, L<=200]"
							data-validation-message="$ must be between 6 and 18 characters. No special characters allowed." />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_title">Title (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_title"
							name="en_title"
						   	value = "{{$en_title}}"
						   	type="text"
						   	placeholder = "Enter English title."
						   	class="form-control"
						   	data-validation="[L>=1, L<=200]"
							data-validation-message="$ must be between 6 and 18 characters. No special characters allowed." />
							
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_description">Description (KH)</label>
				<div class="col-sm-10">
					<div class="summernote-theme-1">
						<textarea id="kh_description" name="kh_description" class="form-control  summernote  ">{{$kh_description}} </textarea>
					</div>	
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_description">Description (EN)</label>
				<div class="col-sm-10">
					<div class="summernote-theme-1">
						<textarea id="en_description" name="en_description" class="form-control  summernote  "> {{$en_description}}</textarea>
					</div>	
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="email">Image</label>
				<div class="col-sm-10">
					<div class="kv-avatar center-block">
				        <input id="image" name="image" type="file" class="file-loading">
				    </div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_content">Status</label>
				<div class="col-sm-10">
					<div class="checkbox-toggle">
						<input id="status-status" type="checkbox"  >
						<label onclick="booleanForm('status')" for="status-status"></label>
					</div>
					<input type="hidden" name="status" id="status" value="">
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