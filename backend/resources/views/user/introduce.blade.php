@extends('main')
    
@section('content')
<style type="text/css">
</style>
<div id="breadcrumb">
	<div class="main">
		<div class="breadcrumbs container">
			<span class="showHere">Bạn đang ở: </span><a href="{{url()}}" class="">Trang chủ</a> <i class="fa fa-caret-right"></i>
			<span>Giới thiệu</span>
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
						<?php echo html_entity_decode($intro->content);?>
					</div>
                <!--end #wrap-details-->

				</div>

			</div>   
			<!-- End article--> 		  
		</div>
	</div>
	</div>

@endsection