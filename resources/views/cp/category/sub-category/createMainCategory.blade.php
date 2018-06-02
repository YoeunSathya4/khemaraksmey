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
	@include('cp.layouts.error')
		@php ($en_name = "")
		@php ($kh_name = "")
       
       	@if (Session::has('invalidData'))
            @php ($invalidData = Session::get('invalidData'))
            @php ($en_name = $invalidData['en_name'])
            @php ($kh_name = $invalidData['kh_name'])
            
       	@endif

   	
	<form id="form" action="{{ route('cp.category.sub-category.store-mainCategory') }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<input type="hidden" name="category_id" value="{{ $id }}">
		<input type="hidden" name="subcategory_id" value="{{ $subcategory_id }}">
		
		<div class="form-group row">
					<label class="col-sm-2 form-control-label" for="en_name">Name (ENG)</label>
					<div class="col-sm-10">
						<input 	id="en_name"
								name="en_name"
							   	value = "{{$en_name}}"
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
							   	value = "{{$kh_name}}"
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
				<button type="submit" class="btn btn-success"> <fa class="fa fa-plus"></i> Create</button>	
			</div>
		</div>
	</form>
@endsection