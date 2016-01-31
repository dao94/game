<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <link rel="shortcut icon" href="assests/style/favicon6753.png" type="image/png" />
    <meta charset="utf-8" />
    <title>
       {{$title}} - {{$setting['site_name']}}
    </title>

    @if(!empty($description))
    <meta name="description" content="{{$description}}">

    <meta name="keywords" content="{{$keywords}}">

    @else
    <meta name="description" content="{{$setting['tag_description']}}">
    <meta name="keywords" content="{{$setting['tag_keyword']}}">
    @endif

    <meta name="author" content="{{$setting['site_name']}}">
    <?php echo html_entity_decode($setting['tag_header'])?>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=0' name='viewport' />
    <link rel="canonical" href="index.html" />
    <script src="{{ asset('assests/global/design/js/jquery.min.1.11.0.js') }}"></script>
    <script src="{{ asset('assests/global/option_selection.js') }} "></script>
    <script src="{{ asset('assests/global/api.jquery.js') }}"></script>
    <script src="{{ asset('assests/global/customer_area.js') }}"></script>
    <script src="{{ asset('assests/global/haravan_common.js') }}"></script>
    <script src="{{ asset('assests/global/design/js/owl.carousel.js') }} " type='text/javascript'></script>
    <link href="{{ asset('assests/style/style6753.css') }} " rel='stylesheet' type='text/css'  media='all'  />
    <link href="{{ asset('assests/style/bootstrap6753.css') }}" rel='stylesheet' type='text/css'  media='all'  />
    <link href="{{ asset('assests/style/owl.carousel6753.css') }}" rel='stylesheet' type='text/css'  media='all'  />
    <link href="{{ asset('assests/style/common6753.css') }}" rel='stylesheet' type='text/css'  media='all'  />
    <link href="{{ asset('assests/style/jquery.fancybox6753.css') }}" rel='stylesheet' type='text/css'  media='all'  />
    <link href="{{ asset('assests/global/design/css/owl.theme.css') }}" rel='stylesheet' type='text/css'  />
    <link href="{{ asset('assests/global/design/css/owl.transitions.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('assests/global/design/css/font-awesome.css') }}" rel='stylesheet' type='text/css'  />
    <script src="{{ asset('assests/style/jquery.mousewheel-3.0.6.pack6753.js') }}" type='text/javascript'></script>
    <script src="{{ asset('assests/style/jquery.cookie6753.js') }}" type='text/javascript'></script>
    <script src="{{ asset('assests/style/bootstrap.min6753.js') }}" type='text/javascript'></script>
    <link href="{{ asset('assests/css.css') }}" rel='stylesheet' type='text/css'  media='all'  />


<link href="{{ asset('assests/style/detail-slider6753.css') }}" rel='stylesheet' type='text/css'  media='all'  />
<script src="{{ asset('assests/style/jquery.flexslider6753.js') }}" type='text/javascript'></script>

    <script>
        $(document).ready(function() {
            $("#slider_img").owlCarousel({
                autoPlay: true,
                items : 1,
                itemsDesktop : [1199,1], 
                itemsDesktopSmall:  [979,1],  
                itemsTablet:    [768,1],
                itemsMobile:    [479,1],            
                mouseDrag : true,      
            }); 
            $("#slider_img_mobile").owlCarousel({
                autoPlay: true,
                items : 1,
                itemsDesktop : [1199,1], 
                itemsDesktopSmall:  [979,1],  
                itemsTablet:    [768,1],
                itemsMobile:    [479,1],            
                mouseDrag : true,      
            });     
        });
    </script>  
</head>
    <body class="">
        <style type="text/css">
            #menu-top-menu{height: 30px}
        </style>
        <div class="TopHeader hidden-sm hidden-xs">
            <div class="container">
                
            
                <div class="pull-right">
                    <ul id="menu-top-menu" class="nav navbar-nav">
                        <li id="menu-item-1864-9" class="">
                            <a title="Trang chủ" href="{{url()}}">
                                <strong>Trang chủ</strong>
                            </a>
                        </li>
                        <li id="menu-item-1864-9" class="">
                            <a title="Giới thiệu" href="{{url()}}/gioi-thieu">
                                <strong>Giới thiệu</strong>
                            </a>
                        </li>
                        <li id="menu-item-7426-596" class="">
                            <a href="{{url()}}/tin-tuc">
                                <strong>Tin tức</strong>
                            </a>
                        </li>
                        <li id="menu-item-7426-596" class="">
                            <a href="{{url()}}/tu-van">
                                <strong>Tư vấn</strong>
                            </a>
                        </li>

                        <li id="menu-item-6807-589" class="">
                            <a href="{{url()}}/lien-he"><strong>Liên hệ</strong></a>
                        </li>
                    </ul>            
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="Container" class="container">
            <div id="Outer">
            
                <!-- header -->
                @include('block.header')
                
                <!-- menu-->
                @include('block.menu')

                @include('block.mobile.menu')

                <script>
                $(".dropdown-li").hover(function() {
                    $(this).addClass("active");
                }, function() {
                    $(this).removeClass("active");
                });
                </script>
                @include('block.menu_top')                

                <div id="Wrapper">
                    @yield('content')                    
                </div>

                <div class="Clear"></div>
            </div>
        </div>
        <!-- footer -->
        @include('block.footer')  
    </body>
</html>