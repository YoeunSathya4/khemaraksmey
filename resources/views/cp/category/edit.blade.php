@extends($route.'.tab')
@section ('section-title', 'Overview')
@section ('tab-active-edit', 'active')
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
		    max-width: 220px;
		}
	</style>
@endsection

@section ('imageuploadjs')
    <script type="text/javascript" src="{{ asset ('public/cp/js/plugin/fileinput/fileinput.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset ('public/cp/js/plugin/fileinput/theme.js') }}" type="text/javascript"></script>
@endsection


@section ('tab-js')
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


	
@endsection

@section ('tab-content')
<div class="container-fluid">
	@include('cp.layouts.error')
	<form id="form" action="{{ route($route.'.update') }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('POST') }}
		<input type="hidden" name="id" value="{{ $data->id }}">
		
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
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
				<button type="button" onclick="deleteConfirm('{{ route($route.'.trash', $data->id) }}', '{{ route($route.'.index') }}')" class="btn btn-danger"> <fa class="fa fa-trash"></i> Delete</button>
			</div>
		</div>
	</form>
</div>
@endsection