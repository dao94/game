@extends('main')
    
@section('content')
<div id="collection">
	<!-- Begin collection info -->
	<!-- Content-->
	<div class="col-md-12">
		<div class="row">
			<div class="main-content-collection">
				<div class="breadcrumb">
					<ul>
						<li><a href="{{url()}}" target="_self">Trang chủ</a></li>
						<li class="active"><span>{{$brand_name}}</span></li>
					</ul>
				</div>
				<div class="defaultTitle TitleContent titlecollection">
					<span class="pull-left">{{$brand_name}}</span>
				</div>						
				<div class="main-product-list">
					<div class="content-product-list">
						@if(!$product)
							<p style="margin:10px">Không có sản phẩm nào !</p>
						@endif

						@foreach($product as $item)
						<?php $img = (json_decode($item->images,true));?>
						<div class="box-product-first col-md-3 col-sm-6 col-xs-6">
							<div id="ProductImage" class="ProductImage">

								<a href="{{url()}}/san-pham/{{$item->slug}}-{{$item->id}}.html" title="{{$item->name}}">
									<img alt="{{$item->alt}}" title="{{$item->name}}" src='{{asset("uploads/$img[0]")}}' class="img-responsive" style="max-height:200px" />
								</a>
							</div>   
							<div class="ProductDetails">
								<h2 title="{{$item->name}}">
									<strong>
										<a href='{{url()}}/san-pham/{{$item->slug}}-{{$item->id}}.html'>
											{{$item->name}}
										</a>
									</strong>
								</h2>
							</div>
							<div class="ProductPrice">
								<div class="special-price">
									<span class="price">
										<em> {{$setting['phone_contact']}}</em>
									</span>
								</div>
							</div>                                
							<div class='ProductActionAdd'>
								<a href='{{url()}}/san-pham/{{$item->slug}}-{{$item->id}}.html'>
									<span>Liên hệ</span>
								</a>
							</div>
						</div>
						<!--end .col-md-3 col-sm-6 col-xs-12-->
						@endforeach
					</div>
				</div>
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
		</div>
	</div>
	<!-- End collection info -->
</div>

@endsection