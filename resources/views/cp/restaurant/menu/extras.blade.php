@extends('cp.restaurant.menu.tabForm')
@section ('section-title', 'Extra')
@section ('tab-active-menu', 'active')
@section ('about-active-extra', 'active')


@section ('imageuploadjs')
   
@endsection

@section ('tab-js')
	
@endsection

@section ('about')
	<br />
	<div>
		<div class="col-md-12">
			<a style="float: right;margin-bottom: 10px;margin-top: -10px;" href="{{ route('cp.restaurant.menu.create-extra',['id'=>$id, 'menu_id'=>$menu_id]) }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span></a>
		</div>
	</div><!--.row-->
	@if(count($data)>0)
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Price</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				@php ($i = 1)
				@foreach ($data as $row)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $row->name }}</td>
						<td>{{ $row->price }} USD</td>
						<td style="white-space: nowrap; width: 1%;">
							<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
	                           	<div class="btn-group btn-group-sm" style="float: none;">
	                           		<a href="{{ route('cp.restaurant.menu.edit-extra', ['restaurant_id'=>$id,'menu_id'=>$menu_id,'extra_id'=>$row->id]) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
	                           		<a href="#" onclick="deleteConfirm('{{ route('cp.restaurant.menu.trash-extra', $row->id) }}', '{{ route('cp.restaurant.menu.extra',['restaurant_id'=>$id,'menu_id'=>$menu_id]) }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
	                           	</div>
	                       </div>
	                    </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div >
	@else
	No Data
	@endif
@endsection