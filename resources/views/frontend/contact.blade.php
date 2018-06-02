@extends('frontend/layouts.master')

@section('title', 'Contact Us')
@section('about-us', 'active')

@section ('appbottomjs')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAkBVGYEGz9qwf0kdb146FdRMui54qu4gw"></script>
<script type="text/javascript">
        function initialize() {

// Create an array of styles.
var styles = [{"featureType":"all","elementType":"labels","stylers":[{"lightness":63},{"hue":"#ff0000"}]},{"featureType":"administrative","elementType":"all","stylers":[{"hue":"#000bff"},{"visibility":"on"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"administrative","elementType":"labels","stylers":[{"color":"#4a4a4a"},{"visibility":"on"}]},{"featureType":"administrative","elementType":"labels.text","stylers":[{"weight":"0.01"},{"color":"#727272"},{"visibility":"on"}]},{"featureType":"administrative.country","elementType":"labels","stylers":[{"color":"#ff0000"}]},{"featureType":"administrative.country","elementType":"labels.text","stylers":[{"color":"#ff0000"}]},{"featureType":"administrative.province","elementType":"geometry.fill","stylers":[{"visibility":"on"}]},{"featureType":"administrative.province","elementType":"labels.text","stylers":[{"color":"#545454"}]},{"featureType":"administrative.locality","elementType":"labels.text","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text","stylers":[{"color":"#7c7c7c"},{"weight":"0.01"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text","stylers":[{"color":"#404040"}]},{"featureType":"landscape","elementType":"all","stylers":[{"lightness":16},{"hue":"#ff001a"},{"saturation":-61}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"color":"#828282"},{"weight":"0.01"}]},{"featureType":"poi.government","elementType":"labels.text","stylers":[{"color":"#4c4c4c"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"hue":"#00ff91"}]},{"featureType":"poi.park","elementType":"labels.text","stylers":[{"color":"#7b7b7b"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.text","stylers":[{"color":"#999999"},{"visibility":"on"},{"weight":"0.01"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"hue":"#ff0011"},{"lightness":53}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#626262"}]},{"featureType":"transit","elementType":"labels.text","stylers":[{"color":"#676767"},{"weight":"0.01"}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#0055ff"}]}];

var loc, map, marker, infobox;

var styledMap = new google.maps.StyledMapType(styles,  {name: "Styled Map"});

loc = new google.maps.LatLng($("#map").attr("data-lat"), $("#map").attr("data-lon"));

map = new google.maps.Map(document.getElementById("map"), {
    zoom: 14,
    center: loc,
    scrollwheel: false,
    //draggable:true,
    navigationControl: false,
    scaleControl: false,
    mapTypeControl:false,
    streetViewControl: false,
    mapTypeControlOptions: {
        mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
    },
    mapTypeId: google.maps.MapTypeId.ROADMAP,
});

//Associate the styled map with the MapTypeId and set it to display.
map.mapTypes.set('map_style', styledMap);
map.setMapTypeId('map_style');

marker = new google.maps.Marker({
    map: map,
    position: loc,
    //disableDefaultUI:true,

    icon:'{{asset('public/frontend/images/map-marker/00.png')}}',
    //pixelOffset: new google.maps.Size(-140, -100),
    visible: true

    //animation: google.maps.Animation.DROP
});

infobox = new InfoBox({
    content: document.getElementById("infobox"),
    disableAutoPan: true,
    //maxWidth: 150,
    pixelOffset: new google.maps.Size(0, -50),
    zIndex: null,
    alignBottom: true,
    isHidden: false,
    //closeBoxMargin: "12px 4px 2px 2px",
    closeBoxURL: "{{asset('public/frontend/images/infobox-close.png')}}",
    closeBoxClass:"infoBox-close",
    infoBoxClearance: new google.maps.Size(1, 1)
});

openInfoBox(marker);

google.maps.event.addListener(marker, 'click', function() {
    openInfoBox(this);
});

function openInfoBox(thisMarker){
    map.panTo(loc);
    map.panBy(0,-80);
    infobox.open(map, thisMarker);
}

var center;
function calculateCenter() {
    center = map.getCenter();
}
google.maps.event.addDomListener(map, 'idle', function() {
    calculateCenter();
});
google.maps.event.addDomListener(window, 'resize', function() {
    map.setCenter(center);
});

}
google.maps.event.addDomListener(window, 'load', initialize);



$(document).ready(function() {
      $("#contact-form").submit(function(event){
        name = $("#name").val();
        email = $("#email").val();
        phone = $("#phone").val();
        subject = $("#subject").val();
        message = $("#message").val();
        g =$('#g-recaptcha-response').val();
        
        if(name != ""){
            if(email != ""){
              if(isEmail(email)){
                if(subject != ""){
                if(phone != ""){
                  if(g != ""){
                    //alert('Go!');
                  }else{
                    error(event, "g-recaptcha-response", '{{ __('general.errorrecaptcha') }}');
                  }
         
                }else{
                  error(event, "phone", '{{ __('general.errorphone') }}');
                }
                }else{
                  error(event, "subject", '{{ __('general.errorsubject') }}');
                }
              }else{
                error(event, "email", '{{ __('general.incorrectemail') }}');
              }
            }else{
              error(event, "email", '{{ __('general.erroremail') }}.');
            }
        }else{
          error(event, "name", '{{ __('general.errorname') }}');
        }
      })

      @if(Session::has('msg'))
        toastr.success("{{ __('general.contact-successful-sent') }}");
      @endif
      @if (count($errors) > 0)
        toastr.warning("{{ __('general.sorry') }}");
      @endif

    });
    function isEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }
    function error(event, obj, msg){
      event.preventDefault();
      toastr.error(msg);
      $("#"+obj).focus();
    }

</script>
@endsection

@section ('content')
<!-- start hero-header -->
            <div class="breadcrumb-wrapper">
            
                <div class="container">
                
                    <ol class="breadcrumb-list">
                        <li><a href="#">Home</a></li>
                        <li><span>Contact Us</span></li>
                    </ol>
                    
                </div>
                
            </div>
            <!-- end hero-header -->
            
            <div class="section sm pb-20">
            
                <div class="container">
                
                    <div class="row">
                    
                        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                        
                            <div class="section-title">
                            
                                <h2>contact us for help</h2>
                                <p>If you any dounts, do not heritage to contact us. We will be happy to serve you. </p>
                                
                            </div>

                        </div>
                    
                    </div>

                    <div class="row mb-40 contact-info">
                        <div class="col-sm-4">
                            <div class="icon icon-default" data-icon="G"></div>
                            <h4>Phnom Penh Office</h4><address><p>Address: No.48EOZ, St.240, Sangkat.Chaktokmuk, khan Doun Penh, Phnom Penh</p></address></div>
                        <div class="col-sm-4">
                            <div class="icon icon-default" data-icon="Q"></div>
                            <h4>Phones &amp; Email</h4>
                            <dl class="dl-horizontal"><dt>Phone:</dt>
                                <dd>
                                    <p>+855 89 999 708<br>+855 96 288 93 58<br>+855 89 899 994</p>
                                </dd><dt>Email:</dt>
                                <dd>
                                    <p><a href="mailto:info@pinkhomedelivery.com">info@pinkhomedelivery.com</a></p>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-sm-4">
                            <div class="icon icon-default" data-icon="2"></div>
                            <h4>Contact Information</h4>
                            <p>We work from 8:00 AM till 5:00 PM.</p>
                        </div>
                    </div>

                </div>
            
            </div>

            <div class="contact-map">
            
                <div id="map" data-lat="11.5449" data-lon="104.8922" style="width: 100%; height: 500px;"></div>

                <div class="infobox-wrapper shorter-infobox contact-infobox">
                    <div id="infobox">
                        <div class="infobox-address">
                            <h6>We Are Here</h6>
                        </div>
                    
                    </div>
                </div>
            
            </div>

            <div class="container">
                <div class="row mt-50 mb-50">

                    <div class="col-sm-12 col-md-12 ">

                        <form class="contact-form" action="{{ route('submit-contact', ['locale'=>$locale]) }}" id="contact-form" data-toggle="validator">

                            <div class="row">

                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="name">Your Name <span class="font10 text-danger">(required)</span></label>
                                        <input id="name" type="text" class="form-control" data-error="Your name is required" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                </div>

                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="email">Your Email <span class="font10 text-danger">(required)</span></label>
                                        <input id="email" type="email" class="form-control" data-error="Your email is required and must be a valid email address" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                </div>
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="phone">Your Phone <span class="font10 text-danger">(required)</span></label>
                                        <input id="phone" type="text" class="form-control" data-error="Your phone is required and must be a valid phone number" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                </div>
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" id="subject" class="form-control" />
                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">
                                        <label for="message">Message </label>
                                        <textarea id="message" class="form-control" rows="8" data-minlength="50" data-error="Your message is required and must not less than 50 characters"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-6 text-right">
                                    <div class="g-recaptcha" data-sitekey="6Lco7EIUAAAAAFp7kdzzh1YvMB2gDc0fhRAe9NDe"></div>
                                </div>
                                <div class="col-sm-6 text-right">

                                    <button type="submit" class="btn btn-primary mt-5">Send Message</button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>
      
@endsection