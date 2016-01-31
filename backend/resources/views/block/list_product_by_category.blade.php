<div id="HomeFeaturedProducts" class="Block FeaturedProducts DefaultModule">
    <div class="defaultTitle TitleContent">
        <span>Sản phẩm bán chạy</span>
    </div>
    <div class="defaultContent BlockContent">
        @foreach ($model->listProductByCategory(null, 0, 4, 1) as $item)
            <?php $img = (json_decode($item->images,true));?>   
        <div class="box-product-first col-md-3 col-sm-6 col-xs-6">
            <div id="ProductImage" class="ProductImage">
                <a href="{{url()}}/san-pham/{{$item->slug}}-{{$item->id}}.html"  >
                    <img alt="{{$item->alt}}" title="{{$item->name}}" 
                             src='{{asset("uploads/$img[0]")}}' class="img-responsive" />
                </a>
            </div>   
            <div class="ProductDetails">
                <h5>
                <strong>
                    <a href='{{url()}}/san-pham/{{$item->slug}}-{{$item->id}}.html' title="{{$item->name}}">
                        {{$item->name}}
                    </a>
                </strong>
                </h5>
            </div>
            <div class="ProductPrice">
                <div class="special-price">
                    <span class="price-label"></span><span class="price"><em>
                    {{$setting['phone_contact']}}</em>
                    </span>
                </div>
            </div>                                
            <div class='ProductActionAdd'>
                <a href='{{url()}}/san-pham/{{$item->slug}}-{{$item->id}}.html'><span>Liên hệ</span></a>
            </div>
        </div>
        <!--end .col-md-3 col-sm-6 col-xs-12--> 
        @endforeach
    </div>
    <div class="Clear"></div>
</div>


@foreach($category_show_in_index as $category)
<div id="HomeFeaturedProducts" class="Block FeaturedProducts DefaultModule">
    <div class="defaultTitle TitleContent">
        <span>{{$category->name}}</span>
    </div>
    <div class="defaultContent BlockContent">
        @foreach ($model->listProductByCategory($category->id, 0, 4) as $item)
            <?php $img = (json_decode($item->images,true));?>   
        <div class="box-product-first col-md-3 col-sm-6 col-xs-6">
            <div id="ProductImage" class="ProductImage">
                <a href="{{url()}}/san-pham/{{$item->slug}}-{{$item->id}}.html"  >
                    <img alt="{{$item->alt}}" title="{{$item->name}}" 
                             src='{{asset("uploads/$img[0]")}}' class="img-responsive" />
                </a>
            </div>   
            <div class="ProductDetails">
                <h5>
                <strong>
                    <a href='{{url()}}/san-pham/{{$item->slug}}-{{$item->id}}.html' title="{{$item->name}}">
                        {{$item->name}}
                    </a>
                </strong>
                </h5>
            </div>
            <div class="ProductPrice">
                <div class="special-price">
                    <span class="price-label"></span><span class="price"><em>
                    {{$setting['phone_contact']}}</em>
                    </span>
                </div>
            </div>                                
            <div class='ProductActionAdd'>
                <a href='{{url()}}/san-pham/{{$item->slug}}-{{$item->id}}.html'><span>Liên hệ</span></a>
            </div>
        </div>
        <!--end .col-md-3 col-sm-6 col-xs-12--> 
        @endforeach
    </div>
    <div class="Clear"></div>
</div>
@endforeach
