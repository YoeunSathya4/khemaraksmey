@extends($route.'.main')
@section ('section-title', 'Create New')
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

			$("#restaurant_id").change(function(){
				getCategory($(this).val());
				$("#category_id").html('<option id="0" >Select Category</option>');
			})
			
		}); 
		
		function getCategory(restaurant_id){
			
			//Get Districts
			$.ajax({
			        url: "{{ route($route.'.get-category') }}?restaurant_id="+restaurant_id,
			        type: 'GET',
			        data: {},
			        success: function( response ) {
			           var category = '';
			            var i;
					    var length = response.length;
					    for (i = 0; i < length; i++) {
					        category += '<option value="'+response[i].id+'" >'+response[i].name+'</option>';
					    }
					    if(category != ""){
					    	$('#category_id').append(category);
					    	
					    }
					    
			        },
			        error: function( response ) {
			           swal("Error!", "Sorry there is an error happens. " ,"error");
			        }
						
			});
		}
	</script>

	

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
		    defaultPreviewContent: '<img src="http://via.placeholder.com/400x200" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 200x165 with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});
	</script>

@endsection

@section ('section-content')
	<div class="container-fluid">
		@include('cp.layouts.error')

		@php ($title_id = 1)
		@php ($name = "")
		@php ($instruction = "")
       
       	@if (Session::has('invalidData'))
            @php ($invalidData = Session::get('invalidData'))
            @php ($name = $invalidData['name'])
            @php ($instruction = $invalidData['instruction'])
            
       	@endif
		<form id="form" action="{{ route($route.'.store') }}" name="form" method="POST"  enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<div class="form-group row">
				<label for="type_id" class="col-sm-2 form-control-label">Restaurant</label>
				<div class="col-sm-10">
					<select id="restaurant_id" name="restaurant_id" class="select2 select2-hidden-accessible" class="form-control">
						<option value="0" >Select Your Restaurant</option>
							
						@foreach( $restaurants as $row )
							
								<option value="{{ $row->id }}" >{{ $row->name }}</option>
							
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="type_id" class="col-sm-2 form-control-label">Category</label>
				<div class="col-sm-10">
					<select id="category_id" name="category_id" class="form-control">
					
						<option value="{{ $row->id }}" >Please Select Restaurant First</option>
						
					</select>
				</div>
			</div>
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
				<label class="col-sm-2 form-control-label" for="name">Name</label>
				<div class="col-sm-10">
					<input 	id="name"
							name="name"
						   	value = "{{$name}}"
						   	type="text"
						   	placeholder = "Eg. Jhon Son"
						   	class="form-control"
						   	data-validation="[L>=2, L<=18, MIXED]"
							data-validation-message="$ must be between 2 and 18 characters. No special characters allowed." />
							
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
				<label class="col-sm-2 form-control-label" for="instruction">Instruction</label>
				<div class="col-sm-10">
					<input 	id="instruction"
							name="instruction"
							value = "{{$instruction}}"
							type="text"
							placeholder = ""
						   	class="form-control">
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