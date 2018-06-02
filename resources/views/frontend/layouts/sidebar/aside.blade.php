


    <!--// Widget Recent Post \\-->
    <div class="widget widget_recent_post">
        <h2 class="findhome-widget-heading findhome-color">{{__('web.related-news')}}</h2>
        <ul>
            @php($related_news = $defaultData['related_news'])
            @foreach($related_news as $row)
            <li>
                <figure><a href="{{route('property-detail',['locale'=>$locale,'slug'=>$row->slug])}}"><img src="{{ asset ($row->image)}}" alt=""><i class="fa fa-angle-double-right"></i></a></figure>
                <div class="widget_recent_post_text">
                    <h6><a href="{{route('property-detail',['locale'=>$locale,'slug'=>$row->slug])}}">{{$row->title}}</a></h6>
                    <time datetime="2008-02-14 20:00">{{ Carbon\Carbon::parse($row->created_dt)->format('d') }} {{ Carbon\Carbon::parse($row->created_dt)->format('M') }} {{ Carbon\Carbon::parse($row->created_dt)->format('Y') }}</time>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <!--// Widget Recent Post \\-->
