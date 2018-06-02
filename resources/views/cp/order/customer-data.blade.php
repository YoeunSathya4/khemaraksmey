@if(sizeof($data) > 0)
<table id="table-edit" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>Name</th>
			
		</tr>
	</thead>	
	<tbody>
		@php ($i = 1)
		@php($j=0)
		@foreach ($data as $row)
			<tr>
				<td>{{ $i++ }}</td>
				<td>
					<div class="checkbox">
						<input type="checkbox" id="customer-{{$row->id}}" class="customerExisting" onclick="selectCustomer({{$row->id}})">
						<label for="customer-{{$row->id}}">{{$row->name}}</label>
					</div>
				</td>
			</tr>
			@endforeach
	</tbody>
</table>

@else
	<span>No Data</span>
@endif