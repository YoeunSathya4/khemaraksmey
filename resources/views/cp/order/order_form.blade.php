@extends($route.'.main')
@section ('section-title', 'Add To Card')
@section ('section-css')
@section ('tab-active-overview', 'active')


@endsection
@section ('section-js')
		
	<script type="text/javascript">
		$(document).ready(function(){
			searchProduct();
			orderSession()
			$( "#customer_key" ).keyup(function() {
			  searchCustomer();
			});
		})
		function searchProduct(){
			key 		= $('#key').val();
			$.ajax({
			        url: "{{ route($route.'.search-product') }}?key="+key,
			        type: 'GET',
			        data: { },
			        success: function( response ) {
			            $("#cnt").html(response)
			        },
			        error: function( response ) {
			           swal("Error!", "Sorry there is an error happens. " ,"error");
			        }
			});
		}
		function searchCustomer(){
			key 		= $('#customer_key').val();
			$.ajax({
			        url: "{{ route($route.'.search-customer') }}?key="+key,
			        type: 'GET',
			        data: { },
			        success: function( response ) {
			            $("#customer-cnt").html(response)
			        },
			        error: function( response ) {
			           swal("Error!", "Sorry there is an error happens. " ,"error");
			        }
			});
		}
		function add(id){
			id                  = id,
			product_id 				= $('#product-id-'+id).val();
			name 				= $('#name-'+id).val();
			qty 				= $('#qty-'+id).val();
			instruction 		= $('#instruction-'+id).val();
			price  				= $('#price-'+id).val();
            
            if(qty != ""){
				$.ajax({
				        url: "{{ route($route.'.add-to-cart') }}",
				        type: 'POST',
				        data: {id:id,product_id:product_id,name:name,qty:qty,instruction:instruction,price:price},
				        success: function( response ) {
				            $("#recent-transactions-cnt").html(response);
				            location.reload();
				        },
				        error: function( response ) {
				           swal("Error!", "Sorry there is an error happens. " ,"error");
				        }
				});
			}else{
          		error(event, "qty", 'please Input Qty');
        	}

		}
		function removeItem(id){
			$.ajax({
				        url: "{{ route($route.'.remove-item') }}",
				        type: 'POST',
				        data: {id:id},
				        success: function( response ) {
				            //add(id);
				             $("#recent-transactions-cnt").html(response);
				             location.reload();
				        },
				        error: function( response ) {
				           swal("Error!", "Sorry there is an error happens. " ,"error");
				        }
				});
		}
		function clearCart(){
			$.ajax({
				        url: "{{ route($route.'.clear-cart') }}",
				        type: 'GET',
				        data: {},
				        success: function( response ) {
				            location.reload();
				        },
				        error: function( response ) {
				           swal("Error!", "Sorry there is an error happens. " ,"error");
				        }
				});
		}

		function error(event, obj, msg){
	      event.preventDefault();
	      toastr.error(msg);
	      $("#"+obj).focus();
	    }

	    function orderSession(){
			$.ajax({
				        url: "{{ route($route.'.order-session') }}",
				        type: 'GET',
				        data: {},
				        success: function( response ) {
				            $("#recent-transactions-cnt").html(response);
				        },
				        error: function( response ) {
				           swal("Error!", "Sorry there is an error happens. " ,"error");
				        }
			});
			

		}
		var customer_id = 0;

		function addNewCustomer(){
			customer_name 				= $('#customer_name').val();
			customer_phone 				= $('#customer_phone').val();

			if(customer_name != ""){
				if(customer_phone != ""){
					$.ajax({
					        url: "{{ route($route.'.add-new-customer') }}",
					        type: 'POST',
					        data: {customer_name:customer_name,customer_phone:customer_phone},
					        success: function( response ) {
					            if(response.status == "success"){
					            	swal("Good Job!", response.message ,"success");
					            	customer_id = response.customer_id
					            }else{
					            	swal("Error!", response.message ,"error");
					            }
					        },
					        error: function( response ) {
					           swal("Error!", "Sorry there is an error happens. " ,"error");
					        }
					});
				}else{
          		error(event, "customer_name", 'Please Input Customer Phone');
        		}
			}else{
          		error(event, "customer_phone", 'Please Input Customer Name');
        	}
		}

		function selectCustomer(cus_id){
			customer_id = cus_id;
			data_check_box = $('.customerExisting:checkbox:checked').on('change', function() {
							    $('.customerExisting:checkbox').not(this).prop('checked', false); 
							});

			//alert(customer_id);
		}
		function addToCart(){
			//customer_id 				= customer_id;
			discount 				= $('#discount').val();
			address 				= $('#address').val();
			delivery_time 				= $('#delivery_time').val();
			
			delivery_id 				= $('#delivery_id option:selected').val();
			location_id 				= $('#location_id option:selected').val();
			if(customer_id != 0){
				$.ajax({
				        url: "{{ route($route.'.add-to-cart-db') }}",
				        type: 'POST',
				        data: {discount:discount,delivery_time:delivery_time,customer_id:customer_id,delivery_id:delivery_id,address:address},
				        success: function( response ) {
				            //add(id);
				             //$("#recent-transactions-cnt").html(response);
				             location.reload();
				        },
				        error: function( response ) {
				           swal("Error!", "Sorry there is an error happens. " ,"error");
				        }
				});
			}else{
          		error(event, "customer_name", 'Please Input Customer');
        	}

		}
	</script>

@endsection

@section ('section-content')
	<div class="row">
		<div class="col-md-6">
				<h5 class="with-border m-t-0">Cards</h5>
				<div class="card-block">
					<div class="row">
						
						<div class="col-xs-11">
							<div class="form-group">
								<input  type="text" class="form-control" id="key" placeholder="Product Name" value="">
							</div>
						</div>
						<div class="col-xs-1">
							<button id="btn-search" onclick="searchProduct()" class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-search"></span></button>
						</div>
						
					</div><!--.row-->
					<div class="row">
						<div id="cnt" class="col-xs-12">
							<b>Please search your products.</b>
						</div>
					</div>

				</div>
		</div>


		<div class="col-md-6">
			<h5 class="with-border m-t-0">Receipt</h5>

			@if (!empty($carts)) 
			<div class="row">
						<br/>
						<div class="col-xs-9">
							<div class="form-group">
							</div>
						</div>
						<div class="col-xs-2">
							<button id="btn-search"  onclick="clearCart()" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="fa fa-times"></span> Clear All Cart</button>
						</div>
						
			</div><!--.row-->
			<br/>


			<div id="recent-transactions-cnt" class="table-responsive">
				
				<div class="card-block">

				</div>

			</div>
			<br/>
			<h3>Customer</h3>
			<div class="col-md-6">
				<h4><u>Existing</u></h4>

					<div class="form-group">
						<input  type="text" class="form-control" id="customer_key" placeholder="Product Name" value="">
					</div>
					<div id="customer-cnt">
						
					</div>
					<!-- <div class="form-group">
				
						<select id="customer_id" class="select2" name="customer_id" class="form-control">
								
								<option value="0" >Select Customer</option>
								@foreach($customers as $customer)
									<option value="{{$customer->id}}" >{{$customer->name}}</option>
								@endforeach
						</select>
					</div> -->
			</div>
			<div class="col-md-6" style="border-left: 1px solid;">
				<h4><u>Add New Customer</u></h3>
				
					<div class="form-group row">
						<label class="col-sm-2 form-control-label" for="customer_name">Name</label>
						<div class="col-sm-10">
							<input 	id="customer_name"
									name="customer_name"
									value = ""
									type="text"
									placeholder = "Eg. Savan"
								   	class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label" for="customer_phone">Phone</label>
						<div class="col-sm-10">
							<input 	id="customer_phone"
									name="customer_phone"
								   	value = ""
								   	type="text" 
								   	placeholder = "Eg. 093123457"
								   	class="form-control"
								   	data-validation="[L>=9, L<=10, numeric]"
									data-validation-message="$ is not correct." 
									data-validation-regex="/(^[00-9].{8}$)|(^[00-9].{9}$)/"
									data-validation-regex-message="$ must start with 0 and has 10 or 11 digits" />
									
						</div>
					</div>
					<button onclick="addNewCustomer()" class="tabledit-edit-button btn btn-sm btn-plus" style="float: right;"><span class="fa fa-plus"></span> Add New Customer</button>
				

			</div>
			
			<h4><u>Delivery</u></h3>
			<div class="form-group">
		
				<select id="delivery_id" class="select2" name="delivery_id" class="form-control">
						
						<option value="0" >Select Delivery</option>
						@foreach($deliveries as $delivery)
							<option value="{{$delivery->id}}" >{{$delivery->name}}</option>
						@endforeach
				</select>
				
				<br>
				<br>
				<input id="address" name="address" value = "" type="text" placeholder = "Please Enter Adress" class="form-control">
				<br>
				<input 	id="delivery_time" name="delivery_time" value = "" type="text" placeholder = "Please Enter Delivery Time Eg. 1 Hours" class="form-control">
				
			</div>
			
			<button onclick="addToCart()" class="tabledit-edit-button btn btn-sm btn-primary" style="float: right;"><span class="fa fa-shopping-cart"></span> Add To Cart</button>
			@else
				<span>No Data</span>
			@endif
		</div>
			
	
@endsection