@extends('cp.restaurant.menu.tabForm')
@section ('section-title', 'Extra')
@section ('tab-active-menu', 'active')
@section ('about-active-extra', 'active')
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

@section ('about')
	@include('cp.layouts.error')

	@php ($name = "")
	@php ($price = "")

   	
	<form id="form" action="{{ route('cp.restaurant.menu.store-extra') }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<input type="hidden" name="restaurant_id" value="{{ $id }}">
		<input type="hidden" name="menu_id" value="{{ $menu_id }}">
		
		<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="name">Name</label>
				<div class="col-sm-10">
					<input 	id="name"
							name="name"
						   	value = "{{$name}}"
						   	type="text"
						   	placeholder = "Please Enter Extra Name"
						   	class="form-control"
						   	data-validation="[L>=1, L<=150]"
							data-validation-message="$ must be between 2 and 18 characters. No special characters allowed." />
							
				</div>
		</div>
		<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="price">Price</label>
				<div class="col-sm-10">
					<input 	id="price"
							name="price"
						   	value = "{{$price}}"
						   	type="number"
						   	placeholder = "Please Enter Price"
						   	class="form-control"
						   	data-validation="[L>=1, L<=150]"
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