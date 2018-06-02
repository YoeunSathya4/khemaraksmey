@extends($route.'.main')
@section ('section-title', 'All Customers')
@section ('display-btn-add-new', 'display:none')
@section ('section-css')

@endsection
@section ('section-js')
	<script type="text/javascript">
	$(document).ready(function() {
			$("#btn-search").click(function(){
				search();
			})
			restaurant 	= $('#restaurant_id').val();
			getCategory(restaurant);
			$("#restaurant_id").change(function(){
				getCategory($(this).val());
				$("#category_id").html('<option id="0" >Select Category</option>');
			})
		});
		function search(){
			key 	= $('#key').val();
			restaurant 	= $('#restaurant_id').val();
			category	= $('#category_id').val();
			type 	= $('#type_id').val();
			d_from 		= $('#from').val();
			d_till 		= $('#till').val();
			limit 		= $('#limit').val();

			url="?limit="+limit;
			if(key!=""){
				url+='&key='+key;
			}
			if(restaurant!=0){
				url+='&restaurant='+restaurant;
			}
			if(category!=0){
				url+='&category='+category;
			}
			if(type!=0){
				url+='&type='+type;
			}
			if(isDate(d_from)){
				if(isDate(d_till)){
					url+='&from='+d_from+'&till='+d_till;
				}
			}
			$(location).attr('href', '{{ route($route.'.index') }}'+url);
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
			        url: "{{ route($route.'.update-status') }}",
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
			function getCategory(restaurant_id){
			
			//Get Districts
			$.ajax({
			        url: "{{ route($route.'.get-category') }}?restaurant_id="+restaurant_id,
			        type: 'GET',
			        data: {},
			        success: function( response ) {
			           $("#category-cnt").html(response) 
			        },
			        error: function( response ) {
			           swal("Error!", "Sorry there is an error happens. " ,"error");
			        }
						
			});
		}
	</script>	
@endsection

@section ('section-content')

<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-4">
		<div class="form-group">
			
			<input  type="text" class="form-control" id="key" placeholder="Key" value="{{ isset($appends['key'])?$appends['key']:'' }}">
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-4">
		<div class="form-group">
			
			<select id="restaurant_id" name="restaurant_id" class="select2 select2-hidden-accessible" class="form-control">
						
						@php( $restaurant = isset($appends['restaurant'])?$appends['restaurant']:0 )

						@if($restaurant != 0)
							@php( $lable = DB::table('restaurants')->find($restaurant) )
							@if( sizeof($lable) == 1 )
								<option value="{{ $lable->id }}" >{{ $lable->name }}</option>
							@endif
						@endif
						<option value="0" >Select Your Restaurant</option>
						@foreach( $restaurants as $row )
							@if($row->id != $restaurant)
								<option value="{{ $row->id }}" >{{ $row->name }}</option>
							@endif
						@endforeach
			</select>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-4">
		<div class="form-group" id="category-cnt">
			
			<select id="category_id" name="category_id" class="form-control">
				
				<option value="0" >Please Select Restaurant First</option>
				
			</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-3">
		<div class="form-group">
			
			<select id="type_id" name="type_id" class="form-control">
						
					@php( $type = isset($appends['type'])?$appends['type']:0 )
					@if($type != 0)
						@php( $lable = DB::table('types')->find($type) )
						@if( sizeof($lable) == 1 )
							<option value="{{ $lable->id }}" >{{ $lable->name }}</option>
						@endif
					@endif
					<option value="0" >Type</option>
					@foreach( $types as $row)
						@if($row->id != $type)
							<option value="{{ $row->id }}" >{{ $row->name }}</option>
						@endif
					@endforeach
			</select>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-3">
			<div class="form-group">
				<div id="from-cnt" class='input-group date'>
					<input id="from" type='text' class="form-control" value="{{ isset($appends['from'])?$appends['from']:'' }}" placeholder="From" />
				<span class="input-group-addon">
					<i class="font-icon font-icon-calend"></i>
				</span>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-6 col-md-3">
			<div class="form-group">
				<div id="till-cnt" class='input-group date ' >
					<input id="till" type='text' class="form-control" value="{{ isset($appends['till'])?$appends['till']:''}}" placeholder="Till" />
					<span class="input-group-addon">
						<i class="font-icon font-icon-calend"></i>
					</span>
				</div>
			</div>
		</div>
	<div class="col-xs-12 col-sm-6 col-md-3">
		<button id="btn-search" class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-search"></span></button>
	</div>
</div>
@if(sizeof($data) > 0)
<div class="table-responsive">
	<table id="table-edit" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Restaurant</th>
				<th>Published</th>
				<th>Image</th>
				<th>Updated Date</th>
				
			</tr>
		</thead>
		<tbody>
			
			@php ($i = 1)
			@foreach ($data as $row)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{ $row->name }}</td>
					<td>{{ $row->restaurant->name }}</td>
					<td>
						<div class="checkbox-toggle">
					        <input onclick="updateStatus({{ $row->id }})" type="checkbox" id="status-{{ $row->id }}" @if ($row->is_published == 1) checked data-value="1" @else data-value="0" @endif >
					        <label for="status-{{ $row->id }}"></label>
				        </div>
					</td>
					<td class="table-photo">
						<img src="{{ asset ($row->image) }}" alt="" data-toggle="tooltip" data-placement="bottom" title="{{ $row->name }}">
					</td>
					<td>{{ $row->updated_at }}</td>
					<!-- <td style="white-space: nowrap; width: 1%;">
						<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                           	<div class="btn-group btn-group-sm" style="float: none;">
                           		<a href="{{ route($route.'.edit', $row->id) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
                           		<a href="#" onclick="deleteConfirm('{{ route($route.'.trash', $row->id) }}', '{{ route($route.'.index') }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
                           	</div>
                       </div>
                    </td> -->
				</tr>
			@endforeach
		</tbody>
	</table>
</div >
@else
	<span>No Data</span>
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