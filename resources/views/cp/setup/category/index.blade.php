@extends($route.'.main')
@section ('section-title', 'Category')
@section ('hide-btn-back', 'display:none')
@section ('section-css')

@endsection
@section ('section-js')
	<script type="text/javascript">
		function update(id){
			value = $("#value-"+id).val();
			if(value != ""){
				$.ajax({
			        url: "{{ route($route.'.update') }}",
			        method: 'POST',
			        data: {id:id, value:value },
			        success: function( response ) {
			            if ( response.status === 'success' ) {
			            	swal("Nice!", response.msg ,"success");
			            	
			            }else{
			            	swal("Error!", "Sorry there is an error happens. " ,"error");
			            }
			        },
			        error: function( response ) {
			           swal("Error!", "Sorry there is an error happens. " ,"error");
			        }
				});
			}else{
				swal("Error!", "Please enter a value." ,"error");
			}
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
			        url: "{{ route($route.'.store') }}",
			        method: 'PUT',
			        data: { value:inputValue},
			        success: function( response ) {
			            if ( response.status === 'success' ) {
			            	swal("Nice!", response.msg ,"success");
			            	window.location.href="{{route($route.'.index')}}";
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

@section ('section-content')
	@if(sizeof($data) > 0)
		<div class="table-responsive">
			<table id="table-edit" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>N. Of Restaurant</th>
						<th>Updated Date</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

					@php ($i = 1)
					@foreach ($data as $row)
						<tr>
							<td>{{ $i++ }}</td>
							<td><input id="value-{{$row->id}}" type="text" class="form-control" value="{{ $row->name }}" /></td>
							<td> {{count($row->restaurants)}} </td>
							<td>{{ $row->updated_at }}</td>
							<td style="white-space: nowrap; width: 1%;">
								<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
		                           	<div class="btn-group btn-group-sm" style="float: none;">
		                           		<button onclick="update({{$row->id}})" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-save"></span></button>
		                           		<a href="#" onclick="deleteConfirm('{{ route($route.'.trash', $row->id) }}', '{{ route($route.'.index') }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
		                           	</div>
		                       </div>
		                    </td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div >
	@else
		<span>No Data</span>
	@endif
@endsection