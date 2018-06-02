@extends('cp.restaurant.tab')
@section ('section-title', 'Add New Menu')
@section ('tab-active-menu', 'active')
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
		    max-width: 200px;
		}
	</style>
@endsection
@section ('imageuploadjs')
    <script type="text/javascript" src="{{ asset ('public/cp/js/plugin/fileinput/fileinput.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset ('public/cp/js/plugin/fileinput/theme.js') }}" type="text/javascript"></script>
@endsection
@section ('section-js')
	<script type="text/JavaScript">
		$(document).ready(function(event){
			$('#form').validate({
				modules : 'file',
				submit: {
					settings: {
						inputContainer: '.form-group',
						errorListClass: 'form-tooltip-error'
					}
				}
			}); 
			
		}); 
		function change_active(){
			val 	= $('#active').val();
			if(val == 0){
				$('#active').val(1);
			}else{
				$('#active').val(0);
			}
		}
	</script>
	<script type="text/JavaScript">
		
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
		    defaultPreviewContent: '<img src="http://via.placeholder.com/200x200" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 200x200 with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});
	
	</script>
@endsection



@section ('tab-content')
	<br />
	<div class="row">
		<div class="col-md-12">
			<a href="{{ route('cp.restaurant.menu.index', $id) }}" class="tabledit-delete-button btn btn-sm btn-primary" style="float: right;"><span class="fa fa-arrow-left"></span></a>
		</div>
	</div><!--.row-->
	@include('cp.layouts.error')
		@php ($active = 0)
		@php ($title_id = 1)
		@php ($name = "")
		@php ($instruction = "")
       
       	@if (Session::has('invalidData'))
            @php ($invalidData = Session::get('invalidData'))
            @php ($active = $invalidData['active'])
            @php ($name = $invalidData['name'])
            @php ($instruction = $invalidData['instruction'])
            
       	@endif
	<form id="form" action="{{ route('cp.restaurant.menu.store') }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<input type="hidden" name="restaurant_id" value="{{ $id}}">

	
		<div class="form-group row">
				<label for="type_id" class="col-sm-2 form-control-label">Type</label>
				<div class="col-sm-10">
					<select id="type_id" name="type_id" class="form-control">
						@foreach( $types as $row )
							<option value="{{ $row->id }}" >{{ $row->name }}</option>
						@endforeach
					</select>
				</div>
		</div>

		<div class="form-group row">
				<label for="category_id" class="col-sm-2 form-control-label">Category</label>
				<div class="col-sm-10">
					@if(sizeof($restaurant_categories) > 0 )
					<select id="category_id" name="category_id" class="form-control">
						
						@foreach( $restaurant_categories as $row )
							<option value="{{ $row->category->id }}" >{{ $row->category->name }}</option>
						@endforeach
					</select>
					@else
					
					<div class="alert alert-danger">
					  <strong>Please add Category in restaurant tab!</strong> 
					</div>
					@endif
				</div>
		</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="name">Name</label>
				<div class="col-sm-10">
					<input 	id="name"
							name="name"
						   	value = "{{$name}}"
						   	type="text"
						   	placeholder = "Eg. Pizza"
						   	class="form-control"
						   	data-validation="[L>=1, L<=150]"
							data-validation-message="$ must be between 1 and 150 characters. No special characters allowed." />
							
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
				<label class="col-sm-2 form-control-label" for="active">Published</label>
				<div class="col-sm-10">
					<div class="checkbox-toggle">
						<input name="active" id="active" type="checkbox"  @if($active ==1 ) checked @endif >
						<label onclick="change_active()" for="active"></label>
					</div>
					<input type="hidden" name="active" id="active" value="{{$active}}">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="instruction">Instruction</label>
				<div class="col-sm-10">
					<textarea class="form-control" name="instruction" >{{$instruction}}</textarea>
				</div>
			</div>
		
			
			<div class="form-group row">
				<label class="col-sm-2 form-control-label"></label>
				<div class="col-sm-10">
					
					<button type="submit" class="btn btn-success"> <fa class="fa fa-plus"></i> Create</button>
				</div>
			</div>
	</form>
	
@endsection