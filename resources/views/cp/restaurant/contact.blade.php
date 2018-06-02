@extends($route.'.tabForm')
@section ('section-title', 'Contact')
@section ('tab-active-edit', 'active')
@section ('about-active-contact', 'active')

@section ('tab-css')
	<link href="{{ asset ('public/cp/css/plugin/fileinput/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset ('public/cp/css/plugin/fileinput/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
	<!-- some CSS styling changes and overrides -->
	<style>
		.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
		    margin: 0;
		    padding: 0;
		    border: none;
		    box-shadow: none;
		    text-align: center;
		}
		.kv-avatar .file-input {
		    display: table-cell;
		    max-width: 220px;
		}
	</style>
@endsection

@section ('imageuploadjs')
    <script type="text/javascript" src="{{ asset ('public/cp/js/plugin/fileinput/fileinput.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset ('public/cp/js/plugin/fileinput/theme.js') }}" type="text/javascript"></script>
@endsection


@section ('tab-js')
	<script type="text/JavaScript">
		$(document).ready(function(event){
		
			$('#form').validate({
				modules : 'file',
				submit: {
					settings: {
						inputContainer: '.form-group',
						errorListClass: 'form-tooltip-error'
					}
				}
			}); 
			
		}); 
		
	</script>

	
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyBbz45_RGsB8xrJtKSgdnL8jJTw0dX-nNw"></script>
	<script type="text/JavaScript">
		$(document).ready(function(){
			
			@if($data->lat != 0 && $data->lon !=0 )
				makeMap({{$data->lat}}, {{$data->lon}}, 20);
			@else 
				makeMap(11.537886, 104.910652, 10);// Map of phnom penh
			@endif
		})
		//var marker ="";
		function makeMap(lat, lon, zoom = 10){
			var latlng = new google.maps.LatLng(lat, lon);
			var map = new google.maps.Map(document.getElementById('map'), {
			    center: latlng,
			    zoom: zoom,
			    mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			var marker = new google.maps.Marker({
			    position: latlng,
			    map: map,
			    title: '',
			    draggable: true
			});
			google.maps.event.addListener(marker, 'dragend', function (event) {
			    $("#lat").val(this.getPosition().lat());
			    $("#lon").val(this.getPosition().lng());
			});
		}

		function enLargeMap(){

		}
	</script>
	
@endsection

@section ('about')
<div class="container-fluid">
	@include('cp.layouts.error')
	<form id="form" action="{{ route($route.'.update-contact') }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('POST') }}
		<input type="hidden" name="id" value="{{ $data->id }}">
		<input type="hidden" name="restaurant_id" value="{{ $data->restaurant_id }}">
		<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="phone_1">Phone 1</label>
				<div class="col-sm-10">
					<input 	id="phone_1"
							name="phone_1"
						   	value = "{{$data->phone_1}}"
						   	type="text"
						   	placeholder = "Eg. 093 254565"
						   	class="form-control"
						   	data-validation="[L>=1, L<=200]"
							 />
							
				</div>
		</div>
		<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="phone_2">Phone 2</label>
				<div class="col-sm-10">
					<input 	id="phone_2"
							name="phone_2"
						   	value = "{{$data->phone_2}}"
						   	type="text"
						   	placeholder = "Eg. 093 254565"
						   	class="form-control"
							 />
							
				</div>
		</div>
		<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="address">Address</label>
				<div class="col-sm-10">
					<input 	id="address"
							name="address"
						   	value = "{{$data->address}}"
						   	type="text"
						   	placeholder = "Eg. Phnom Penh Cambodia"
						   	class="form-control"
							 />
							
				</div>
		</div>
		<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="opened">Opened Time</label>
				<div class="col-sm-10">
					<input 	id="opened"
							name="opened"
						   	value = "{{$data->opened}}"
						   	type="text"
						   	placeholder = "Eg. 8:00 am"
						   	class="form-control"
							 />
							
				</div>
		</div>
		<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="closed">Closed Time</label>
				<div class="col-sm-10">
					<input 	id="closed"
							name="closed"
						   	value = "{{$data->closed}}"
						   	type="text"
						   	placeholder = "Eg. 6:00 pm"
						   	class="form-control"
							 />
							
				</div>
		</div>
		<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Latitude </label>
				<div class="col-sm-10">
					<input 	id="lat"
							name="lat"
							value = "{{ $data->lat }}"
							type="text"
							placeholder = ""
						   	class="form-control"/>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Longitude</label>
				<div class="col-sm-10">
					<input 	id="lon"
							name="lon"
							value = "{{ $data->lon }}"
							type="text"
							placeholder = ""
						   	class="form-control"/>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_content">Display Map</label>
				<div class="col-sm-10">
					<div class="radio">
						<input type="radio" name="is-actual-map" id="radio-1" value="1" @if($data->is_actual_map == 1 ) checked @endif>
						<label for="radio-1">Actual</label>
					</div>
					<div class="radio">
						<input type="radio" name="is-actual-map" id="radio-2" value="0" @if($data->is_actual_map == 0 ) checked @endif>
						<label for="radio-2">Surounded</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" >Map</label>
				<div id="map-cnt" class="col-sm-10">
					<div id="map" style="height:400px;border: 1px solid gray;"></div>
				</div>
			</div>

		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
				
			</div>
		</div>
	</form>
</div>
@endsection