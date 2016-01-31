@extends('main')
    
@section('content')
<style type="text/css">
	.entry-title{margin-top: 0px}
	.entry-title a{font-size: 13px;text-transform: uppercase;}
	.head-recent{font-size: 11px;}
	.head-recent:hover{text-decoration: none}
	.post-date{padding-bottom: 0px;}
</style>
<div id="wrap-page-blog">
	<section id="content-blog" class="light_section blog right-sidebar">
		<!-- main content -->
		<div class="col-sm-8 col-md-8 col-lg-9 box-blog">
			@foreach($news as $items)
				<article class="post format-standard">
					<div class="col-md-5 col-sm-5 col-xs-12 box-blog-img-left">
						<div class="entry-thumbnail">
							<p>
								<img alt="{{$items->name}}" src='{{asset("uploads/$items->images")}}' style="max-height:150px"><br data-mce-bogus="1">
							</p>
						</div>
					</div>
					<div class="col-md-7 col-sm-7 col-xs-12 colum-right-blog">
						<h2 class="entry-title">
							<a href="{{url()}}/tin-tuc/{{$items->slug}}-{{$items->id}}.html" rel="bookmark">{{$items->name}}</a>
						</h2>
						<div class="entry-meta">
							<span class="date">
								<time class="entry-date"><i class="fa fa-calendar"></i> <span>{{$items->create_time}}</span></time>
							</span>
						</div>
						<!-- .entry-meta --> 
					</div>
					<!-- .entry-header -->
					<div class="entry-content">
						<p>
							{{$items->description}}
						</p>
					</div>
					<!-- .entry-content -->
					<div class="entry-tags">
						<span class="readmore pull-right">
							<a href="{{url()}}/tin-tuc/{{$items->slug}}-{{$items->id}}.html">Xem thêm</a>
						</span>
					</div>
					<!-- .entry-tags -->
				</article>
			@endforeach
			<!-- .post -->

		</div> <!--eof col-sm-9 (main content)-->

		<!-- Sidebar -->
		<aside class="col-sm-4 col-md-4 col-lg-3 sidebar-right-blog">              
			<div class="widget widget_popular_entries">
				<h3 class="widget-title">Bài viết mới nhất</h3>
				<ul class="media-list">
					<img src="{{url()}}/assests/media-list-icon.jpg" class="img-responsive"/>
					@foreach($news as $item)
					<li class="media">
						<div class="media-body">
							<p class="media-heading">
								<a href="{{url()}}/tin-tuc/{{$item->slug}}-{{$item->id}}" class="head-recent">{{$item->name}}</a>
							</p>
							<p class="post-date">{{$item->create_time}}</p>
						</div>
					</li>
					@endforeach	
				</ul>			
			</div>
		</aside>
		<!-- end sidebar -->
	</section>

	<section id="pagination" class="grey_section" >
		<div class="col-md-12 ">
			<div class="text-right">
				<nav>
				  <ul class="pagination">
				  	<?php 
				  		for ($i=1; $i < $total_page+ 1; $i++) { 
		  					echo '<li class="'.((isset($_GET['page']) && $_GET['page'] == $i) ? "active" : "false").'" ><a href="?page='.$i.'" >'.$i.'</a></li>';
				  		}
				  	?>
				  </ul>
				</nav>

			</div>
		</div>
	</section>
</div>
@endsection