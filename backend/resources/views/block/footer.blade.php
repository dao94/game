<div class="bg-footer">
    <div id="Footer">
        <div id="FooterContainer" class="footer-info container">
            <div class="col-md-2 col-sm-6 col-xs-6 box-footer box-footer-1">
                <ul class="form1">
                    <li><a href="{{url()}}">Trang chủ</a></li>                         
                                            
                    <li><a href="{{url()}}/gioi-thieu">Giới thiệu</a></li>

                    <li><a href="{{url()}}/huong-dan-mua-hang">Hướng dẫn</a></li>                            
                                            
                    <li><a href="{{url()}}/tin-tuc">Tin tức</a></li>                         
                                            
                    <li><a href="{{url()}}/lien-he">Liên hệ</a></li>                           
                </ul>
            </div><!--end .col-md-3 col-sm-6 col-xs-12 -->
            <div class="col-md-6 col-sm-6 col-xs-12 box-footer">
                <ul>
                    <li><span>Giới thiệu</span></li>
                </ul>
                <ul class="form" id="footer_3">
                    <?php echo html_entity_decode($setting['contact_information']);?>
                </ul>
            </div><!--end .col-md-3 col-sm-6 col-xs-12 -->
            <div class="col-md-4 col-sm-6 col-xs-12 box-footer">
                <ul>
                    <li><span>Facebook</span></li>
                </ul>
                <ul class="form form-fb">                           
                    <li>
                        <div class="fb-page" data-href="{{$setting['fanpage_code']}}" data-tabs="timeline" data-width="300" data-height="200" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"></div>
                    </li>
                </ul>
            </div><!--end .col-md-3 col-sm-6 col-xs-12 -->  
            <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "http://connect.facebook.net/en_US/sdk.js#xfbml=1&appId=263266547210244&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
            </script>
        </div>
        <div class="Clear"></div>
    </div>
</div>