@extends('main')
    
@section('content')


<!-- slide-->
@include('block.mobile.slide')

<!-- category -->
@include('block.category')            

<script>
$.fn.extend({
    Select: function() {
        return $(this).addClass('open');
    },
    Unselect: function() {
        return $(this).removeClass('open');
    },
    MyApplication: {
        Ready: function() {
            $('li.level0').click(
                function() {
                    $(this).hasClass('open')?$(this).Unselect() : $(this).Select();   
                }
            );
        }
    }
});

$(document).ready(
    function() {
        $.fn.MyApplication.Ready();
    }
);
</script>

    <div id="SideTopSeller" class="TopSellers Moveable Panel DefaultModule">
        @include('block.product_hot')    
    </div>

    <div class="newsLastest DefaultModule CustomNews-1802162">
        @include('block.news')
    </div>

</div>
 <div class="main-right col-sm-9 col-xs-12">
        @include('block.slide')

        <div id="cphMain_ctl00_ContentPane" class="center col-sm-12">
            @include('block.list_product_by_category')
        </div>
        
    </div>
@endsection