@if(sizeof($data) > 0)
		<div class="table-responsive">
			<table id="table-edit" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Price</th>
						<th>QTY</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

					@php ($i = 1)
					@foreach ($data as $row)
						<tr>
							<td>
								<input type="hidden" name="product_id" id="product-id-{{$row->id}}" value="{{ $row->id }}">
								<input type="hidden" name="name" id="name-{{$row->id}}" value="{{ $row->en_name }}">
							
								<b>{{ $row->en_name }}</b>
							</td>
							<td>
								<input type="hidden" name="price" id="price-{{$row->id}}" value="{{ $row->unit_price }}">
								{{ $row->unit_price }}
							</td>
							<td>
								<input  type="number" min=1 class="form-control" id="qty-{{$row->id}}" placeholder="" value="1"> <br />
								<textarea class="form-control" id="instruction-{{$row->id}}" placeholder="Instruction"></textarea>
							</td>
							
							<td style="white-space: nowrap; width: 1%;">
								<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
		                           	<div class="btn-group btn-group-sm" style="float: none;">
		                           		<button class="tabledit-edit-button btn btn-sm btn-success" onclick="add({{$row->id}})" style="float: none;"><span class="fa fa-check"></span></button>
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