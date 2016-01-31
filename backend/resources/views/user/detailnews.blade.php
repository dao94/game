@extends('main')
    
@section('content')
<style type="text/css">
</style>
<div id="breadcrumb">
	<div class="main">
		<div class="breadcrumbs container">
			<span class="showHere">Bạn đang ở: </span><a href="../../" class="pathway">Trang chủ</a> <i class="fa fa-caret-right"></i>
			<span>{{$news->name}}</span>
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

					<div class="col-sm-8 col-md-8 col-lg-9 box-blog">	
						<div class="col-md-12 padding_none">
							<!--Begin:ngày giờ đăng bài viết  -->							
							<h2 class="title-article">{{$news->name}}</h2>						
							<div class="entry-meta">
								<span class="date">
									<time class="entry-date"><i class="fa fa-calendar"></i>{{$news->create_time}}</time>
								</span>
								
							</div>
							<!-- .entry-meta -->
							<!--End:ngày giờ đăng bài viết  -->
						</div>				
						<div class="body-content">
							<?php echo html_entity_decode($news->content)?>
						</div>
						<!-- End article comments -->			
						
						<br/><br/>
						
						<strong>Chia sẻ : </strong> <br/><br/><div class="clearfix"></div>
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
			<!-- End article--> 		  
		</div>
	</div>

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