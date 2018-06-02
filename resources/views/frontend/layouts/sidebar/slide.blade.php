<section class="subheader subheader-slider subheader-slider-with-filter">
	  <div class="slider-wrap">
	    <div class="slider-nav slider-nav-simple-slider">
	      <span class="slider-prev"><i class="fa fa-angle-left"></i></span>
	      <span class="slider-next"><i class="fa fa-angle-right"></i></span>
	    </div>

	    <div class="slider slider-simple">
	    @php($slides = $defaultData['slides'])
	     @foreach($slides as $row)
	      <div class="slide" style="background: url({{ asset ($row->media->slide) }}) no-repeat center; width: 100%;">
	        <div class="img-overlay black"></div>
	        <div class="container">
	          <h1>{{$row->name}}</h1>
	          <p><i class="fa fa-map-marker icon"></i>{{$row->location->address}}</p>
	          <div class="slider-simple-buttons">
	            <a href="{{ route('property-detail', ['locale'=>$locale, 'slug'=>$row->slug]) }}" class="button">{{__('web.view-detail')}}</a>
	            <a href="#" class="button">{{__('web.contact-agent')}}</a>
	          </div>
	        </div>
	      </div>
	      @endforeach
	      <!-- <div class="slide">
	        <div class="img-overlay black"></div>
	        <div class="container">
	          <h1>Beautiful Waterfront Home</h1>
	          <p><i class="fa fa-map-marker icon"></i> 432 Smith Dr. Balitmore, MD</p>
	          <div class="slider-simple-buttons">
	            <a href="index-slider-3.html#" class="button">View Details</a>
	            <a href="index-slider-3.html#" class="button">Contact Agent</a>
	          </div>
	        </div>
	      </div> -->
	    
	    </div><!-- end slider -->
	  </div><!-- end slider wrap -->
</section>