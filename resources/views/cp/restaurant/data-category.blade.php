<h2>All Category</h2>
@if(sizeof($data) > 0)
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
					@foreach ($data as $row)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $row->name }}</td>
							<td style="white-space: nowrap; width: 1%;">
								<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
		                           	<div class="btn-group btn-group-sm" style="float: none;">
		                           		<a href="#" class="tabledit-edit-button btn btn-sm btn-success" onclick="add({{$row->id}})" style="float: none;"><span class="fa fa-check"></span></a>
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