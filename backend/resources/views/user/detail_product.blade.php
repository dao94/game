@extends('main')
    
@section('content')
<style type="text/css">
</style>
<div id="breadcrumb">
	<div class="main">
		<div class="breadcrumbs container">
			<span class="showHere">Bạn đang ở: </span><a href="../../" class="pathway">Trang chủ</a> <i class="fa fa-caret-right"></i>
			<span>{{$product->name}}</span>
		</div>
	</div>
</div>
<div id="article">
	<div class="article" >
		<div class="main-content">			
			<!-- Begin article -->
			<div id="layout-page-article">
				<div class="content-page">
					<div class="col-md-4 col-lg-3 sidebar-left-blog-article">
						<div id="main-content-left" class="left col-sm-3 col-xs-12">
						    @include('block.sidebar')
						</div><!--end main-content-left-->
					</div>

					<div id="wrap-detail" class="main-right col-sm-9 col-xs-12">
                    <div id="wrap-detail-container">
                        <div id="detail-content">
                            <div class="col-lg-6 col-xs-12 detail-content-left">
                                <div id="product-top-sub-left">
                                    <div id="slider" class="flexslider">
                                        <ul class="slides">
                                          	@foreach(json_decode($product->images) as $img)
									
                                            <li>
                                                <img src='{{asset("uploads/$img")}}' alt="" class="img-responsive" />
                                            </li>
                                            @endforeach

                                            
                                        </ul>
                                    </div>
                                    <div id="carousel" class="flexslider">
                                        <ul class="slides">

											@foreach(json_decode($product->images) as $img)		

                                            <li>
                                                <img src='{{asset("uploads/$img")}}' alt="" />
                                            </li>

                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                                <!--end #product-top-sub-left-->
                            </div>
                            <!--end .col-lg-7 col-xs-12 detail-content-left-->
                            <div class="col-lg-6 col-xs-12 detail-content-right">
                                <div class="row">
                                    <div class="col-lg-12 col-ms-12 col-sm-6 col-xs-12 box-detail-content-right-1">
                                        <div class="ProductMain">
                                            <div class="product-title">
                                                <h1 class="title-product-detail">{{$product->name}}</h1>
                                            </div>
                                            <div class="ProductDetailsGrid">
                                                <div class="Row SKU">
                                                    <div class="ProductManufacture">
                                                        <span class="LabelManufacture">
                											Nhà sản xuất:
                										</span>
                                                        <span class="VariationManufacture">
                											{{$product->provider ? $product->provider->name : ''}}
                										</span>
                                                    </div>
                                                    <div class="Clear"></div>
                                                </div>
                                                <p>{{$product->description}}</p>
                                                <div class="Row Price">
                                                    <span class="LabelPrice">Liên hệ</span>
                                                    <div class="ProductPrice VariationProductPrice price">
                                                        <span id="our_price_display" class="price-detail" style='font-size:16px'> {{$setting['phone_contact']}} </span>
                                                    </div>
                                                </div>

                                                    <div class="DetailRow">
                                                        <div class="Row AddCartButton ProductAddToCart">
                                                            
                                                            <div id="BulkDiscount">
                                                            
                                                                <button type="submit" name="add" id="addToCart" class="btn">
                                                                    <span class="icon icon-cart"></span>
                                                                    <span id="addToCartText" class="BulkDiscount"><i class="fa fa-phone"></i> Liên hệ</span>
                                                                </button>

                                                                <span id="variantQuantity" class="variant-quantity"></span>
                                                            </div>

                                                            <div class="Clear"></div>
                                                        </div>
                                                    </div><br/><br/>
                                                     <div class="Row Price">

                                                            <div class="ProductPri1ce VariationProduct1Price p1rice">
                                                                <ul class="share-buttons">
                                                                  <li><a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}&t=" title="Share on Facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;"><img src="/images/flat_web_icon_set/color/Facebook.png"></a></li>
                                                                  <li><a href="https://twitter.com/intent/tweet?source={{Request::url()}}&text=:%20http%3A%2F%2Fdaunhonthuyluc.com" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;"><img src="/images/flat_web_icon_set/color/Twitter.png"></a></li>
                                                                  <li><a href="https://plus.google.com/share?url={{Request::url()}}" target="_blank" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;"><img src="/images/flat_web_icon_set/color/Google+.png"></a></li>
                                                                  <li><a href="mailto:?subject=&body=:%20{{Request::url()}}" target="_blank" title="Email" onclick="window.open('mailto:?subject=' + encodeURIComponent(document.title) + '&body=' +  encodeURIComponent(document.URL)); return false;"><img src="/images/flat_web_icon_set/color/Email.png"></a></li>
                                                                </ul>
                                                            </div>
                                                    </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end .col-lg-4 col-md-4 col-sm-4 col-xs-12 detail-content-right-->
                        </div>
                        <!--end #detail-content-->

                        <div id="detail-des" class="row">
                            <div class="col-lg-12 detail-des-left">
                                <ul id="detail-tab-left" role="tablist">
                                    <li role="presentation" class="active"><a href="#detail-des-content1" aria-controls="detail-des-content1" role="tab" data-toggle="tab">Thông tin chi tiết</a></li>
                                    <li role="presentation"><a href="#detail-des-as2" aria-controls="detail-des-content1" role="tab" data-toggle="tab">Hướng dẫn mua hàng</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="detail-des-content1">
                                    	<?php echo html_entity_decode($product->content)?>
                                    </div>
                                    <div role="tabpanel" class="tab-pane " id="detail-des-as2">
                                        <?php echo html_entity_decode($guideDes->content);?>
                                    </div>
                                </div>
                                <!--end .tab-content-->
                            </div>
                            <!--end .col-lg-8 col-md-8 col-sm-8 col-xs-12 detail-des-left-->



                        </div>
                        <!--end #detail-des-->


                        <div class="Block FeaturedProducts DefaultModule" id="product-details-bottom">
                            <div class="defaultTitle TitleContent">
                                <span>Sản phẩm cùng loại</span>
                            </div>
                            <div class="defaultContent BlockContent">




								@foreach ($releated_product as $item)

								
                                <div class="box-product-first col-md-3 col-sm-6 col-xs-6">
                                    <div id="ProductImage" class="ProductImage">
                                        <a href="{{url()}}/san-pham/{{$item->slug}}-{{$item->id}}.html">
                                        	<?php 
                                        		$img = json_decode($item->images);

                                        	?>
                                            <img alt="{{$item->name}}" src='{{asset("uploads/$img[0]")}}' class="img-responsive" />
                                        </a>
                                    </div>


                                    <div class="ProductDetails">
                                        <strong><a href="{{url()}}/san-pham/{{$item->slug}}-{{$item->id}}.html">
										{{$item->name}}</a></strong>
                                    </div>
                                    <div class="ProductPrice">
						                <div class="special-price">
						                    <span class="price-label"></span><span class="price"><em>
						                    {{$setting['phone_contact']}}</em>
						                    </span>
						                </div>
						            </div>    
                                    <div class='ProductActionAdd'><a href="{{url()}}/lien-he"><span>Liên hệ</span></a></div>
                                </div>
                                <!--end .col-md-3 col-sm-6 col-xs-12-->
                                @endforeach

                            </div>
                        </div>

                    </div>
                    <!--end .container-->
                </div>
                <!--end #wrap-details-->

				</div>

			</div>   
			<!-- End article--> 		  
		</div>
	</div>
	</div>
<script type="text/javascript">
	// JS SLIDER   
	$(window).load(function(){
	$('#carousel').flexslider({
	animation: "slide",
	controlNav: false,
	animationLoop: false,
	slideshow: false,
	itemWidth: 106,
	itemMargin: 5,
	asNavFor: '#slider'
	});

	$('#slider').flexslider({
	animation: "slide",
	controlNav: false,
	animationLoop: false,
	slideshow: false,
	sync: "#carousel",
	start: function(slider){
	$('body').removeClass('loading');
	}
	});    
	});
</script>

<style type="text/css">
 
    ul.share-buttons{
      list-style: none;
      padding: 0;
      margin-left: 0px !important;
    }

    ul.share-buttons li{
      display: inline;
      margin-right: 5px;
    }
 
</style>
@endsection