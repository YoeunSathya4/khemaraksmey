<h2>Selected Category</h2>
@if(sizeof($restaurant_categories) > 0)
		<div class="table-responsive">
			<table id="table-edit" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

					@php ($i = 1)
					@foreach ($restaurant_categories as $row)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $row->category->name }}</td>
							<td style="white-space: nowrap; width: 1%;">
								<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
		                           	<div class="btn-group btn-group-sm" style="float: none;">
		                           		<a href="#" class="tabledit-edit-button btn btn-sm btn-danger"  onclick="remove({{$row->category->id}})" style="float: none;"><span class="fa fa-times"></span></a>
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