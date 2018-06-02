@extends('cp.restaurant.tab')
@section ('section-title', 'Menu')
@section ('tab-active-menu', 'active')

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
		$(location).attr('href', '{{ route('cp.restaurant.menu.index', $id) }}'+url);
	}
	function updateStatus(id){
		     	thestatus = $('#status-'+id);
		     	active = thestatus.attr('data-value');

		     	if(active == 1){
		     		active = 0;
		     		thestatus.attr('data-value', 1);
		     	}else{
		     		active = 1;
		     		thestatus.attr('data-value', 0);
		     	}

		     	$.ajax({
			        url: "{{ route('cp.restaurant.menu.update-menu-status') }}",
			        method: 'POST',
			        data: {id:id, active:active },
			        success: function( response ) {
			            if ( response.status === 'success' ) {
			            	swal("Nice!", response.msg ,"success");
			            	
			            }else{
			            	swal("Error!", "Sorry there is an error happens. " ,"error");
			            }
			        },
			        error: function( response ) {
			           swal("Error!", "Sorry there is an error happens. " ,"error");
			        }
				});
			}
</script>

@section ('tab-content')
	

	<div class="row">
		<div class="col-md-3">
			
			<select id="category_id" class="form-control">	
		 		@php( $category_id = isset($appends['category_id'])?$appends['category_id']:0 )
				@if($category_id != 0)
					@php( $lable = DB::table('categories')->find($category_id) )
					@if( sizeof($lable) == 1 )
						<option value="{{ $lable->id }}" >{{ $lable->name }}</option>
					@endif
				@endif
				<option value="0" >Category</option>
				@foreach( $categories as $row)
					@if($row->id != $category_id)
						<option value="{{ $row->category_id }}" >{{ $row->category->name }}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="col-md-3">
			<input type="text" placeholder="Name" id="key" class="form-control" value="{{isset($_GET['key'])?$_GET['key']:''}}" />
		</div>
		
		
		<div class="col-md-3">
			<button onclick="search()"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-search"></span></button>
			<a href="{{ route('cp.restaurant.menu.create', ['id'=>$id]) }}" class="tabledit-delete-button btn btn-sm btn-primary" ><span class="fa fa-plus"></span></a>
		</div>
	</div><!--.row-->
	<br />
	
	@if(sizeof($data) > 0)
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Code</th>
					<th>Category</th>
					<th>Name</th>
					<th>Publish</th>
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
						<td>{{menuCode($row->id)}}</td>
						<td>{{$row->category->name}}</td>
						<td>{{$row->name}}</td>
						<td>
								<div class="checkbox-toggle">
							        <input onclick="updateStatus({{ $row->id }})" type="checkbox" id="status-{{ $row->id }}" @if ($row->is_published == 1) checked data-value="1" @else data-value="0" @endif >
							        <label for="status-{{ $row->id }}"></label>
						        </div>
						</td>

						<td>
							@if($row->image!="")
								<img src="{{asset('public/uploads/restaurant/menu/'.$row->image)}}" class="img img-responsive" />
							@else
								No Image Avaiable
							@endif
						</td>
						<td>{{ $row->updated_at }}</td>
						<td style="white-space: nowrap; width: 1%;">
							<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
	                           	<div class="btn-group btn-group-sm" style="float: none;">
	                           		
	                           		<a href="{{ route('cp.restaurant.menu.edit', ['id'=>$id, 'menu_id'=>$row->id]) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
	                           		<a href="#" onclick="deleteConfirm('{{ route('cp.restaurant.menu.trash', ['id'=>$id, 'menu_id'=>$row->id]) }}', '{{ route('cp.restaurant.menu.index', ['id'=>$id]) }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
	                           		
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