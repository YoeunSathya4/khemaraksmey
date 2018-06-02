@extends('cp.category.sub-category.tabForm')
@section ('section-title', 'Size')
@section ('tab-active-sub-category', 'active')
@section ('about-active-main-category', 'active')
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
			<a style="float: right;margin-bottom: 10px;margin-top: -10px;" href="{{ route('cp.category.sub-category.create-mainCategory',['id'=>$id, 'category_id'=>$id]) }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span></a>
		</div>
	</div><!--.row-->
	@include('cp.layouts.error')
	<form id="form" action="{{ route('cp.category.sub-category.update-mainCategory', $id) }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('POST') }}
		<input type="hidden" name="category_id" value="{{ $id }}">
		<input type="hidden" name="subcategory_id" value="{{ $subcategory_id }}">
		<input type="hidden" name="maincategory_id" value="{{ $maincategory_id }}">
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
				<button type="button" onclick="deleteConfirm('{{ route('cp.category.sub-category.trash-mainCategory', $data->id) }}', '{{ route('cp.category.sub-category.mainCategory',['category_id'=>$id,'subcategory_id'=>$subcategory_id]) }}')" class="btn btn-danger"> <fa class="fa fa-trash"></i> Delete</button>
			</div>
		</div>
	</form>
@endsection