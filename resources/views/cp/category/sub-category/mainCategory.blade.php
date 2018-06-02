@extends('cp.category.sub-category.tabForm')
@section ('section-title', 'Size')
@section ('tab-active-sub-category', 'active')
@section ('about-active-main-category', 'active')


@section ('imageuploadjs')
   
@endsection

@section ('tab-js')
	
@endsection

@section ('about')
	<br />
	<div>
		<div class="col-md-12">
			<a style="float: right;margin-bottom: 10px;margin-top: -10px;" href="{{ route('cp.category.sub-category.create-mainCategory',['id'=>$id, 'subcategory_id'=>$subcategory_id]) }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span></a>
		</div>
	</div><!--.row-->
	@if(count($data)>0)
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name in Khmer</th>
					<th>Name in English</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				@php ($i = 1)
				@foreach ($data as $row)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $row->kh_name }}</td>
						<td>{{ $row->en_name }} USD</td>
						<td style="white-space: nowrap; width: 1%;">
							<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
	                           	<div class="btn-group btn-group-sm" style="float: none;">
	                           		<a href="{{ route('cp.category.sub-category.edit-mainCategory', ['category_id'=>$id,'subcategory_id'=>$subcategory_id,'maincategory_id'=>$row->id]) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
	                           		<a href="#" onclick="deleteConfirm('{{ route('cp.category.sub-category.trash-mainCategory', $row->id) }}', '{{ route('cp.category.sub-category.mainCategory',['category_id'=>$id,'subcategory_id'=>$subcategory_id]) }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
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