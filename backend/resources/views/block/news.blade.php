<div class="defaultTitle newsLastest-Title">
    <span>Tin Tức</span>
</div>
<div class="defaultContent newsLastest-content">
    @foreach($listNewsTop as $item)
        <div class="newsLastest_Item">
            <div class="newsLastest_Image col-sm-5">
                <a href="{{url()}}/tin-tuc/{{$item->slug}}-{{$item->id}}.html">
                    <img alt="{{$item->name}}" src='{{asset("uploads/$item->images")}}' data-mce-src='{{asset("uploads/$item->images")}}' style="max-height:40px">
                    <br data-mce-bogus="1">
                </a>
            </div>
            <div class="newsLastest_Title col-sm-7">
                <a href="{{url()}}/tin-tuc/{{$item->slug}}-{{$item->id}}.html">
                    <span>
                        {{$item->name}}
                    </span>
                </a>                
            </div>
            <div class="Clear"></div>
        </div><!--end newslasttest-item-->
    @endforeach

</div>  
