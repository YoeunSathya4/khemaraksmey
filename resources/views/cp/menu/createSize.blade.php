@extends($route.'.tab')
@section ('section-title', 'Create Size')
@section ('tab-active-size', 'active')
@section ('tab-css')
	<style type="text/css">
		.margin-top-10{
			margin-top:10px;
		}
		
	</style>
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
	</script>

@endsection

@section ('tab-content')
	@include('cp.layouts.error')

	@php ($name = "")
	@php ($price = "")

   	
	<form id="form" action="{{ route($route.'.store-size') }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<input type="hidden" name="id" value="{{ $id }}">
		
		<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="name">Name</label>
				<div class="col-sm-10">
					<input 	id="name"
							name="name"
						   	value = "{{$name}}"
						   	type="text"
						   	placeholder = "Please Enter Size Name"
						   	class="form-control"
						   	data-validation="[L>=2, L<=150, MIXED]"
							data-validation-message="$ must be between 2 and 18 characters. No special characters allowed." />
							
				</div>
		</div>
		<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="price">Price</label>
				<div class="col-sm-10">
					<input 	id="price"
							name="price"
						   	value = "{{$price}}"
						   	type="text"
						   	placeholder = "Please Enter Price"
						   	class="form-control"
						   	data-validation="[L>=2, L<=150]"
							data-validation-message="$ must be between 2 and 18 characters. No special characters allowed." />
							
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