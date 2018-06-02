@extends('cp.restaurant.menu.tabForm')
@section ('section-title', 'Size')
@section ('tab-active-menu', 'active')
@section ('about-active-size', 'active')
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
	<br />
	<div>
		<div class="col-md-12">
			<a style="float: right;margin-bottom: 10px;margin-top: -10px;" href="{{ route('cp.restaurant.menu.create-size',['id'=>$id, 'menu_id'=>$menu_id]) }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span></a>
		</div>
	</div><!--.row-->
	@include('cp.layouts.error')
	<form id="form" action="{{ route('cp.restaurant.menu.update-size', $id) }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('POST') }}
		<input type="hidden" name="restaurant_id" value="{{ $id }}">
		<input type="hidden" name="menu_id" value="{{ $menu_id }}">
		<input type="hidden" name="size_id" value="{{ $size_id }}">
		<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="name">Name</label>
				<div class="col-sm-10">
					<input 	id="name"
							name="name"
						   	value = "{{$data->name}}"
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
						   	value = "{{$data->price}}"
						   	type="number"
						   	placeholder = "Please Enter Price"
						   	class="form-control"
						   	data-validation="[L>=2, L<=150]"
							data-validation-message="$ must be between 2 and 18 characters. No special characters allowed." />
							
				</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
				<button type="button" onclick="deleteConfirm('{{ route('cp.restaurant.menu.trash-size', $data->id) }}', '{{ route('cp.restaurant.menu.size',['restaurant_id'=>$id,'menu_id'=>$menu_id]) }}')" class="btn btn-danger"> <fa class="fa fa-trash"></i> Delete</button>
			</div>
		</div>
	</form>
@endsection