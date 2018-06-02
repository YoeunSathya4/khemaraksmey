@extends('cp.category.sub-category.tabForm')
@section ('section-title', 'Edit Sub Category')
@section ('tab-active-sub-category', 'active')
@section ('about-active-overview', 'active')

@section ('tab-css')
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
		    defaultPreviewContent: '<img src="@if($data->image != '') {{ asset('public/uploads/subcategory/image/'.$data->image) }} @else http://via.placeholder.com/200x200 @endif" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 200x200 px with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});
	
	</script>
@endsection



@section ('about')
	<br />
	<div class="row">
		<div class="col-md-12">
			<a href="{{ route('cp.category.sub-category.create', $id) }}" class="tabledit-delete-button btn btn-sm btn-primary" style="float: right; margin-left: 4px;"><span class="fa fa-plus"></span></a> &nbsp;
			<a href="{{ route('cp.category.sub-category.index', $id) }}" class="tabledit-delete-button btn btn-sm btn-primary" style="float: right;"><span class="fa fa-arrow-left"></span></a>
		</div>
	</div><!--.row-->
	@include('cp.layouts.error')
	<form id="form" action="{{ route('cp.category.sub-category.update') }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('POST') }}
		<input type="hidden" name="category_id" value="{{ $id}}">
		<input type="hidden" name="subcategory_id" value="{{ $data->id}}">

		<div class="form-group row">
					<label class="col-sm-2 form-control-label" for="en_name">Name (ENG)</label>
					<div class="col-sm-10">
						<input 	id="en_name"
								name="en_name"
							   	value = "{{$data->en_name}}"
							   	type="text"
							   	placeholder = "Please enter name in English"
							   	class="form-control"
							   	data-validation="[L>=1, L<=200]"
								 />
								
					</div>
			</div>
			<div class="form-group row">
					<label class="col-sm-2 form-control-label" for="kh_name">Name (KHM)</label>
					<div class="col-sm-10">
						<input 	id="kh_name"
								name="kh_name"
							   	value = "{{$data->kh_name}}"
							   	type="text"
							   	placeholder = "Please enter name in Khmer"
							   	class="form-control"
							   	data-validation="[L>=1, L<=200]"
								 />
								
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
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
				<button type="button" onclick="deleteConfirm('{{ route('cp.category.sub-category.trash', ['id'=>$id, 'menu_id'=>$data->id]) }}', '{{ route('cp.category.sub-category.index', $id) }}')" class="btn btn-danger"> <fa class="fa fa-trash"></i> Delete</button>
			</div>
		</div>
	</form>
	
@endsection