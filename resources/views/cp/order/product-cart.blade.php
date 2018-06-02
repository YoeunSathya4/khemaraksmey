@if(sizeof($carts) > 0)
	
		<div class="table-responsive">
			<table id="table-edit" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Product</th>
						<th>Instruction</th>
						<th>Price</th>
						<th>QTY</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@php($total_amount = 0)
					@php($sumExtra = 0)
					@php ($i = 1)
					@foreach ($carts as $row)
						
						@php($total_amount += $row['price'] * $row['qty'])

						<tr>
							<td>
								<input type="hidden" name="name" id="name" value="">
								<b>{{$row['name']}}</b>
							</td>
							
							<td>{{$row['instruction']}}</td>
							<td>{{$row['price']}} $</td>
							<td>{{$row['qty']}}</td>
							
						
							<td><a href="#" class="tabledit-edit-button btn btn-sm btn-danger" onclick="removeItem({{$row['id']}})" style="float: none;"><span class="fa fa-times"></span></a></td>
					@endforeach	

						<tr>
							<td colspan="4" style="text-align: right;">Total in USD</td>
							<td>$ {{$total_amount + $sumExtra}}</td>
						</tr>
						<tr>
							<td colspan="4" style="text-align: right;">Discount ( % )</td>
							<td><input 	id="discount" name="discount" value = "0" type="text" placeholder = "Enter Discount" class="form-control"></td>
						</tr>
				</tbody>
			</table>
			
			
		</div >
	@else
		<span>No Data</span>
	@endif