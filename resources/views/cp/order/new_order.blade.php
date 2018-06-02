@extends($route.'.main')
@section ('section-title', 'All Customers')
@section ('display-btn-add-new', 'display:none')
@section ('section-css')

@endsection
@section ('section-js')
	<script type="text/javascript">
		function orderData(id){
			$.ajax({
		        url: "{{ route($route.'.order-data') }}",
		        type: 'GET',
		        data: {id:id },
		        success: function( response ) {
		            $("#order-data-cnt").html(response) 
		        },
		        error: function( response ) {
		           swal("Error!", "Sorry there is an error happens. " ,"error");
		        }
		
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
				<th>Success</th>
				<th>Address</th>
				<th>Delevery Time</th>
				<th>Discount</th>
				
			</tr>
		</thead>
		<tbody>
			
			@php ($i = 1)
			@foreach ($data as $row)
				<tr>
					<td>{{ $i++ }}</td>
					<td ><div class="checkbox-toggle">
							        <input  onclick="updateStatus({{ $row->id }})" type="checkbox" id="status-{{ $row->id }}" @if ($row->is_success == 1) checked data-value="1" @else data-value="0" @endif >
							        <label  for="status-{{ $row->id }}"></label>
						        </div></td>
						<td>{{ $row->address }}</td>
						<td>{{ $row->delivery_time }}</td>
						<td>{{ $row->discount }}</td>
					<td><a href="#" onclick="orderDetail({{$row->id}})" class="tabledit-edit-button btn btn-sm btn-success" data-toggle="modal" data-target="#orderDetail" style="float: none;"><span class="fa fa-eye"></span></a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div >
@else
	<span>No Data</span>
@endif
<!-- Modal -->
	<div id="orderDetail" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Order</h4>
	      </div>
	      <div class="modal-body">
	        		<div id="order-data-cnt" class="container-fluid">
						
						
					</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
@endsection