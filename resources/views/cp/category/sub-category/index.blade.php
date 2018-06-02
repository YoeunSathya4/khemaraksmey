@extends('cp.category.tab')
@section ('section-title', 'Category')
@section ('tab-active-sub-category', 'active')

@section ('tab-js')
<script type="text/javascript">
	function search(){
		
		key 	= $('#key').val();
		category_id 	= $('#category_id').val();
		limit 	= $('#limit').val();

		url="?limit="+limit;
		if(category_id!=0){
			url=url+"category_id="+category_id;
		}
		if(key!=""){
			url=url+"&key="+key;
		}
		$(location).attr('href', '{{ route('cp.category.sub-category.index', $id) }}'+url);
	}
	
</script>

@section ('tab-content')
	

	<div class="row">

		<div class="col-md-3">
			<input type="text" placeholder="Name" id="key" class="form-control" value="{{isset($_GET['key'])?$_GET['key']:''}}" />
		</div>
		
		
		<div class="col-md-3">
			<button onclick="search()"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-search"></span></button>
			<a href="{{ route('cp.category.sub-category.create', ['id'=>$id]) }}" class="tabledit-delete-button btn btn-sm btn-primary" ><span class="fa fa-plus"></span></a>
		</div>
	</div><!--.row-->
	<br />
	
	@if(sizeof($data) > 0)
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name in Khmer</th>
					<th>Name in English</th>
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
						<td>{{$row->kh_name}}</td>
						<td>{{$row->en_name}}</td>
						

						<td>
							@if($row->image!="")
								<img src="{{asset('public/uploads/subcategory/image/'.$row->image)}}" class="img img-responsive" />
							@else
								No Image Avaiable
							@endif
						</td>
						<td>{{ $row->updated_at }}</td>
						<td style="white-space: nowrap; width: 1%;">
							<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
	                           	<div class="btn-group btn-group-sm" style="float: none;">
	                           		
	                           		<a href="{{ route('cp.category.sub-category.edit', ['id'=>$id, 'menu_id'=>$row->id]) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
	                           		<a href="#" onclick="deleteConfirm('{{ route('cp.category.sub-category.trash', ['id'=>$id, 'subcategory_id'=>$row->id]) }}', '{{ route('cp.category.sub-category.index', ['id'=>$id]) }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
	                           		
	                           	</div>
	                       </div>
	                    </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div >

	@else
	<span>No data</span>
	@endif
	<div class="row">
		<div class="col-xs-2">
			<select id="limit" onchange="search()" class="form-control" style="margin-top: 15px;width:50%">
				@if(isset($appends['limit']))
				<option>{{ $appends['limit'] }}</option>
				@endif
				<option>10</option>
				<option>20</option>
				<option>30</option>
				<option>40</option>
				<option>50</option>
				<option>60</option>
				<option>70</option>
				<option>80</option>
				<option>90</option>
				<option>100</option>
			</select>
		</div>
		<div class="col-xs-10">

			{{ $data->appends($appends)->links('vendor.pagination.custom-html') }}
		</div>
	</div>
@endsection