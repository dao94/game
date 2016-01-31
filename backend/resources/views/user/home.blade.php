@extends('main')

@section('content')
<!-- slide-->
@include('block.mobile.slide')
<div id="main-content-left" class="left col-sm-3 col-xs-12">
    @include('block.sidebar')
</div><!--end main-content-left-->
<div class="main-right col-sm-9 col-xs-12">
    @include('block.slide')
    <div id="cphMain_ctl00_ContentPane" class="center col-sm-12">
        @include('block.list_product_by_category')
    </div>
</div>
@endsection