<div id="Menu">               
    <div id="menu-container">
        <ul class="nav navbar-nav navbar-static-top">
	    <li>
                <a href="{{url()}}">TRANG CHỦ</a>
            </li>
            @foreach($menu_provider as $item)
            @if(count($item->child) > 0)
            <li class="dropdown-li">
                <a href="{{url()}}/nhan-hieu/{{$item->slug}}-{{$item->id}}.html" class="dropdown-link-sub">{{$item->name}} <span class="caret"></span></a>
                <ul class="dropdown-menu-sub">
                    @foreach($item->child as $val)
                    <li><a href="{{url()}}/nhan-hieu/{{$val->slug}}-{{$val->id}}.html">{{$val->name}}</a></li>
                    @endforeach
                </ul>
            </li>
            @else
            <li>
                <a href="{{url()}}/nhan-hieu/{{$item->slug}}-{{$item->id}}.html">{{$item->name}}</a>
            </li>
            @endif
            @endforeach
	     <li>
                <a href="{{url()}}/lien-he">LIÊN HỆ</a>
            </li>
        </ul>                        
    </div>
    <div class="clearfix"></div>
    
</div>


<script>
    $('#Menu').affix({
      offset: {
        top: 0
      }
    });

    $('#Menu').on('affix.bs.affix', function (){
        $("#menu-container").addClass('container');
    });

    $('#Menu').on('affix-top.bs.affix', function (){
        $("#menu-container").removeClass('container');
    });


</script>
<style>
    .affix
{
    top: 0;
    left:0;
    right:0;
    border-radius: 0!important;
    z-index: 99999!important;
}
</style>
