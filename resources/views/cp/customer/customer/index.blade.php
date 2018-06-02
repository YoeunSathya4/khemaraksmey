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
		});
		function search(){
			key 	= $('#key').val();
			email 	= $('#email').val();
			phone 	= $('#phone').val();
			d_from 		= $('#from').val();
			d_till 		= $('#till').val();
			limit 		= $('#limit').val();

			url="?limit="+limit;
			if(key!=""){
				url+='&key='+key;
			}
			if(email!=""){
				url+='&email='+email;
			}
			if(phone!=""){
				url+='&phone='+phone;
			}
			if(isDate(d_from)){
				if(isDate(d_till)){
					url+='&from='+d_from+'&till='+d_till;
				}
			}
			$(location).attr('href', '{{ route($route.'.index') }}'+url);
		}

	    function changePassword(id) {
	     	swal({
						title: "Reset Password",
						text: "",
						type: "input",
						showCancelButton: true,
						closeOnConfirm: false,
						inputPlaceholder: "Please type a new Password:"
					}, function (inputValue) {
						if (inputValue === false) return false;
						if (inputValue.length <6 ){
	                        toastr.error("Your password at least 6 digits long!");
							return false
						}
						$.ajax({
						        url: "{{ route($route.'.update-password') }}",
						        type: 'POST',
						        data: {id:id, password:inputValue },
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
	            })
	    }

	    function updateEmail(id){
         	theemail = $('#email-'+id);
         	email = theemail.attr('data-value');

         	if(email == 1){
         		email = 0;
         		theemail.attr('data-value', 1);
         	}else{
         		email = 1;
         		theemail.attr('data-value', 0);
         	}

         	$.ajax({
		        url: "{{ route($route.'.update-email') }}",
		        method: 'POST',
		        data: {id:id, email:email },
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
    	function updatePhone(id){
         	thephone = $('#phone-'+id);
         	phone = thephone.attr('data-value');

         	if(phone == 1){
         		phone = 0;
         		thephone.attr('data-value', 1);
         	}else{
         		phone = 1;
         		thephone.attr('data-value', 0);
         	}

         	$.ajax({
		        url: "{{ route($route.'.update-phone') }}",
		        method: 'POST',
		        data: {id:id, phone:phone },
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
@endsection

@section ('section-content')
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-2">
		<div class="form-group">
			
			<input  type="text" class="form-control" id="key" placeholder="Key" value="{{ isset($appends['key'])?$appends['key']:'' }}">
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-2">
		<div class="form-group">
			
			<input  type="text" class="form-control" id="phone" placeholder="Phone" value="{{ isset($appends['phone'])?$appends['phone']:'' }}">
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-2">
		<div class="form-group">
			
			<input  type="text" class="form-control" id="email" placeholder="Email" value="{{ isset($appends['email'])?$appends['email']:'' }}">
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-2">
			<div class="form-group">
				<div id="from-cnt" class='input-group date'>
					<input id="from" type='text' class="form-control" value="{{ isset($appends['from'])?$appends['from']:'' }}" placeholder="From" />
				<span class="input-group-addon">
					<i class="font-icon font-icon-calend"></i>
				</span>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-6 col-md-2">
			<div class="form-group">
				<div id="till-cnt" class='input-group date ' >
					<input id="till" type='text' class="form-control" value="{{ isset($appends['till'])?$appends['till']:''  }}" placeholder="Till" />
					<span class="input-group-addon">
						<i class="font-icon font-icon-calend"></i>
					</span>
				</div>
			</div>
		</div>
	<div class="ccol-xs-12 col-sm-12 col-md-2">
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
				<th>Phone</th>
				<th>Email</th>
				<th>Email Verified</th>
				
				<th>Phone Verified</th>
				<th>Last Updated</th>
				<th>Avatar</th>
				<th></th>
			</tr>
		</thead>
		<tbody>

			@php ($i = 1)
			@foreach ($data as $row)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{ $row->name }}</td>
					<td>{{ $row->phone }}</td>
					<td>{{ $row->email }}</td>
					<td>
						<div class="checkbox-toggle">
					        <input onclick="updateEmail({{ $row->id }})" type="checkbox" id="email-{{ $row->id }}" @if ($row->is_email_verified == 1) checked data-value="1" @else data-value="0" @endif >
					        <label for="email-{{ $row->id }}"></label>
				        </div>
					</td>
					
					<td>
						<div class="checkbox-toggle">
					        <input onclick="updatePhone({{ $row->id }})" type="checkbox" id="phone-{{ $row->id }}" @if ($row->is_phone_verified == 1) checked data-value="1" @else data-value="0" @endif >
					        <label for="phone-{{ $row->id }}"></label>
				        </div>
					</td>
					<td>{{ $row->updated_at }}</td>
					<td class="table-photo">
						<img src="{{ asset ($row->image) }}" alt="" data-toggle="tooltip" data-placement="bottom" title="{{ $row->name }}">
					</td>
					<td style="white-space: nowrap; width: 1%;">
						<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                           	<div class="btn-group btn-group-sm" style="float: none;">
                           		<a href="{{ route($route.'.edit', $row->id) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
                           		<a href="#" onclick="changePassword({{ $row->id }})" class="tabledit-edit-button btn btn-sm btn-warning" style="float: none;"><span class="fa fa-key"></span></a>
                           		<a href="#" onclick="deleteConfirm('{{ route($route.'.trash', $row->id) }}', '{{ route($route.'.index') }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
                           	</div>
                       </div>
                    </td>
				</tr>
			
			@endforeach
			
			
		</tbody>
	</table>
</div >
@else 
	<p>No Data</p>
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

<!-- Note: <br />
- If Status is marked with blue color, User can are active on the system else he/she cannot access.<br />
- If Agent is marked with blue color, User can be visible on website.<br />
- If Validate IP is marked with blue color, User cannot log to the system with other internet beside company. However, User having position as andmin is still able.<br /> -->


@endsection