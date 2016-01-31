<div class="defaultTitle SideTopSeller-Title">
        <span>Sản phẩm mới</span>
    </div>
    <div class="defaultContent SideTopSeller-content">
        <div class="BlockContent">
            <ul class="ProductList" id="productlist-left">
                @foreach($listNewPd as $id => $item)
                <li class="Even">
                    
                    <div class="ProductDetails">
                        <strong>
                            <a href='{{url()}}/san-pham/{{$item->slug}}-{{$item->id}}.html'>
                                {{$item->name}}
                            </a>
                        </strong>
                    </div>
                </li><!--end-list event-->
                @endforeach

            </ul>
        </div>
        <div class="Clear">
        </div>
    </div>  