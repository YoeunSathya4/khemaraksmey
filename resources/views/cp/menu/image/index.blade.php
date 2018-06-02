@extends('cp.menu.tab')
@section ('section-title', 'Image')
@section ('tab-active-photo', 'active')
@section ('tab-content')
	<br />
	<div class="row">
		<div class="col-md-12">
			@if(checkRole($id, 'create-photo'))
			<a href="{{ route('cp.menu.image.create', ['id'=>$id]) }}" class="tabledit-delete-button btn btn-sm btn-primary" style="float: right;"><span class="fa fa-plus"></span></a>
			@endif
		</div>
	</div><!--.row-->
	<br />
	@if(sizeof($data) > 0)
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Image</th>
					<th>Updated Date</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				@php ($i = 1)
				@foreach ($data as $row)
					<tr>
						<td>{{ $i++ }}</td>
						<td><img src="{{ asset($row->image) }}" class="img img-responsive" /> </td>
						<td>{{ $row->updated_at }}</td>
						<td style="white-space: nowrap; width: 1%;">
							<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
	                           	<div class="btn-group btn-group-sm" style="float: none;">
	                           		
	                           		<a href="{{ route('cp.menu.image.edit', ['id'=>$id, 'image_id'=>$row->id]) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
	                           		
	                           		
	                           		<a href="#" onclick="deleteConfirm('{{ route('cp.menu.image.trash', ['id'=>$id, 'image_id'=>$row->id]) }}', '{{ route('cp.menu.image.index', ['id'=>$id]) }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
	                           		
	                           	</div>
	                       </div>
	                    </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div >
	@else
	<span>No Images</span>
	@endif
@endsection