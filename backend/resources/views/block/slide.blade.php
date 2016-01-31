<div id="main-slider" class="top col-sm-12">                                               
    <div id="slider_img">
        @foreach($slide as $item)
            <div class="content-sliders">                          
                <img src='{{asset("uploads/$item->images")}}' alt="2323123" class="img-responsive"/>
            </div>  
        @endforeach
    </div>                       
</div><!--end #main-slider-->