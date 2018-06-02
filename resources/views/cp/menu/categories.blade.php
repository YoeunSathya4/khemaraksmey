@extends('cp.menu.tab')
@section ('section-title', 'Category')
@section ('tab-active-type', 'active')
@section ('tab-css')
	
@endsection


@section ('tab-js')
<script type="text/javascript">
	$(document).ready(function(){
		$('.item').click(function(){
			check_id = $(this).attr('for');
			category_id = $("#"+check_id).attr('category-id');
			categories(category_id);
		})
	})
	function categories(category_id){
		$.ajax({
		        url: "{{ route('cp.menu.check-categories') }}?menu_id={{ $id }}&category_id="+category_id,
		        type: 'GET',
		        data: { },
		        success: function( response ) {
		            if ( response.status === 'success' ) {
		            	toastr.success(response.msg);
		            }else{
		            	swal("Error!", "Sorry there is an error happens. " ,"error");
		            }
		        },
		        error: function( response ) {
		           swal("Error!", "Sorry there is an error happens. " ,"error");
		        }
		});
	}
</script>
@endsection

@section ('tab-content')

	@if(sizeof($categories) > 1)
		<div class="row m-t-lg">
			@foreach($categories as $row)
				@php( $check = "" )
				@foreach($menus as $menu)
					@if($menu->category_id==$row->id)
						@php( $check = "checked" )
					@endif
					
				@endforeach
				<div class="col-xs-12 col-sm-6 col-sm-4 col-md-3 col-lg-3">
					<div class="checkbox-bird">
						<input type="checkbox" category-id="{{ $row->id }}" id="category-{{ $row->id }}" {{ $check }} >
						<label class="item" for="category-{{ $row->id }}">{{ $row->name }}</label>
					</div>
				</div>
			@endforeach
		</div>
	@else
	<p>No data Here</p>
	@endif
@endsection