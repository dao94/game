<div id="cate-menu" class="DefaultModule cate-menu">
    <div class="defaultTitle cate-menu-title">
        <span>Danh mục sản phẩm</span>
    </div>
    <div class="defaultContent cate-menu-content">
        <ul>
            @foreach ($Category as $cat)
            <li class="level0">
                @if (count($cat->child) > 0)
                    <a id="click-sub-menu-left" href="javascript:void(0);">
                        <span>
                            {{$cat->name}}</span>
                            <i class="fa fa-caret-right icon-right" ></i>
                    </a>
                @else 
                    <a id="click-sub-menu-left" href="{{url()}}/danh-muc/{{$cat->slug}}-{{$cat->id}}.html">
                        <span>
                            {{$cat->name}}</span>
                    </a>
                @endif
                @if (count($cat->child) > 0)
                <ul class="sub-menu-left">
                    @foreach ($cat->child as $child)
                    <li class="level1">
                        <a href="{{url()}}/danh-muc/{{$child->slug}}-{{$child->id}}.html">
                            <span>
                                {{$child->name}}</span></a>                        
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>