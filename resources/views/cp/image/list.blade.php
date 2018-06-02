
@extends('cp.layouts.app')

@section('title', 'User')

@section ('appbottomjs')
	<script type="text/javascript">
		function updateStatus(id){
         	active = $('#published-'+id);
         	published = active.attr('data-value');

         	if(published == 1){
         		published = 0;
         		active.attr('data-value', 1);
         	}else{
         		published = 1;
         		active.attr('data-value', 0);
         	}
         	
         	//alert(published);
         	$.ajax({
					        url: "{{ route('user.image.update-status') }}",
					        method: 'POST',
					        data: {id:id, published:published },
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

@section ('page-content')
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Content</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
						
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
		<div class="row">
			
			<section class="card">
				<div class="card-block">
					<h5 class="m-t-lg with-border"><b style="text-transform: capitalize;">{{ $page }} Page</b></h5>
					<div class="table-responsive">
								<table id="table-edit" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Publish</th>
									<th>Update At</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@php ($menu = "")
							    @if(isset($_GET['menu']))
							        @php( $menu = $_GET['menu'])
							    @endif

							    @php ($page = "")
							    @if(isset($_GET['page']))
							        @php( $page = $_GET['page'])
							    @endif

								@php ($i = 1)
								@foreach ($data as $row)
								
									<tr>
										<td>{{ $i++ }}</td>
										<td>{{ $row->name }}</td>
										<td>
											<div class="checkbox-toggle">
										        <input onclick="updateStatus({{ $row->id }})" type="checkbox" id="published-{{ $row->id }}" @if ($row->published == 1) checked data-value="1" @else data-value="0" @endif >
										        <label for="published-{{ $row->id }}"></label>
									        </div>
										</td>
										<td>{{ $row->updated_at }}</td>
										
										<td style="white-space: nowrap; width: 1%;">
											<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
	                                           	<div class="btn-group btn-group-sm" style="float: none;">
	                                           		<a href="{{ route('user.image.edit', ['slug' => $row->slug]) }}?menu={{ $menu }}&page={{ $page }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></a>
	                                           	</div>
	                                       </div>
	                                    </td>
									</tr>
								
								@endforeach
							</tbody>
						</table>
					</div >
					
				</div>
				
					
			</section><!--.box-typical-->
		</div>
	</div><!--.container-fluid-->

@endsection