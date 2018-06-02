@extends($route.'.tabForm')
@section ('section-title', 'Category')
@section ('tab-active-edit', 'active')
@section ('about-active-category', 'active')
@section ('tab-css')
	
@endsection


@section ('tab-js')
<script type="text/javascript">
	$(document).ready(function(){
		getCategorySearch();
		getCategoryResult();
		
		$("#btn-search").click(function(){
				getCategorySearch();
			})
	})
	
	function getCategorySearch(){
		key 		= $('#search').val();
		$.ajax({
		        url: "{{ route($route.'.get-categories') }}?id={{$id}}&key="+key,
		        type: 'GET',
		        data: { },
		        success: function( response ) {
		            $("#category-cnt").html(response)
		        },
		        error: function( response ) {
		           swal("Error!", "Sorry there is an error happens. " ,"error");
		        }
		});
	}
	function getCategoryResult(){
		$.ajax({
		        url: "{{ route($route.'.selected',$id) }}",
		        type: 'GET',
		        data: { },
		        success: function( response ) {
		            $("#selected").html(response)
		        },
		        error: function( response ) {
		           swal("Error!", "Sorry there is an error happens. " ,"error");
		        }
		});
	}
	function add(category_id){
			
			$.ajax({
			        url: "{{ route($route.'.add') }}?id={{ $id }}&category_id="+category_id,
			        type: 'PUT',
			        data: {},
			        success: function( response ) {
			          toastr.success("{{ __('Category has been added') }}");
			          getCategorySearch();
			          getCategoryResult();
			        },
			        error: function( response ) {
			           swal("Error!", "Sorry there is an error happens. " ,"error");
			        }	
			});
		}
	function remove(category_id){
			$.ajax({
			        url: "{{ route($route.'.remove') }}?id={{ $id }}&category_id="+category_id,
			        type: 'DELETE',
			        data: {},
			        success: function( response ) {
			          toastr.success("{{ __('Category has been removed') }}");
			          getCategorySearch();
			          getCategoryResult();
			        },
			        error: function( response ) {
			           swal("Error!", "Sorry there is an error happens. " ,"error");
			        }	
			});
		}

		function create(){
			swal({
				title: "Category",
				text: "Please name this type:",
				type: "input",
				showCancelButton: true,
				closeOnConfirm: false,
				inputPlaceholder: "Write something"
			}, function (inputValue) {
				if (inputValue === false) return false;
				if (inputValue === "") {
					swal.showInputError("You need to write something!");
					return false
				}
				
				//swal("Nice!", "You wrote: " + inputValue, "success");
				$.ajax({
			        url: "{{ route($route.'.store-category') }}",
			        method: 'PUT',
			        data: { value:inputValue},
			        success: function( response ) {
			            if ( response.status === 'success' ) {
			            	swal("Nice!", response.msg ,"success");
			            	//window.location.href="{{route($route.'.index')}}";
			            	getCategorySearch();
							getCategoryResult();
			            }else{
			            	swal("Error!", "Sorry there is an error happens. " ,"error");
			            }
			        },
			        error: function( response ) {
			           swal("Error!", "Sorry there is an error happens. " ,"error");
			        }
				});

			});
		}
</script>
@endsection

@section ('about')

	<div class="row" style="padding: 10px;">
			<div class="col-xs-12 col-sm-12 col-md-3">
				<div class="form-group">
					<input  type="text" class="form-control" id="search" placeholder="Key" value="">
				</div>
			</div>
			<div class="ccol-xs-12 col-sm-12 col-md-3">
				<button id="btn-search" class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-search"></span></button>
				<button onclick="create()"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span></button>
			</div>
	</div>
	<div id="category-cnt" class="col-xs-6">
		
		
	</div>
	<div class="col-xs-6" id="selected">
		
	</div>
@endsection