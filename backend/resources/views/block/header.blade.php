<div class="clearfix"></div>
<style type="text/css">
    .phone-header{background-position: none}
</style>
<div id="Header" style="margin-top:-10px">
    <div id="Logo" class="col-md-3 col-sm-6 col-xs-12">
        <div id="LogoContainer"><a href="{{url()}}"><img src='{{asset("uploads/".$setting["banner"])}}' class="img-responsive" alt="{{$setting['site_name']}}"/></a></div>
    </div>
    <div class="seach-header col-md-6 col-sm-6 col-xs-12">
        <div id="SearchForm">
            <div id="SearchFormContainer">
                <form action="{{url()}}/tim-kiem">        
                    <input type="hidden" name="type" value="product" class="search-input" placeholder="Tìm kiếm ..." />
                    <input type="text" name="query"  class="search-input" placeholder="Tìm kiếm ..." />
                    <input type="submit" name="" value="" id="ctlSearch_ctl00_btnSearch" class="search-button" />
                </form>             
            </div>
        </div>
        <span class="pro-header">
            Từ khóa : Dầu công nghiệp, dầu thủy lực ....
        </span>
    </div>
    <div class="phone-header col-md-3 col-sm-12 col-xs-12" style="margin-bottom:30px;">
        <a style="font-size:22px;font-style:italic;margin-top:-5px;margin-left:40px" class="col-md-12">
            <?php echo str_replace('-','</br>',$setting['phone_contact'])?>
        </a>
        <a style="font-size:13px;font-style:italic;margin-left:40px;margin-top:5px" class="col-md-12">
            Email : {{$setting['email_notice']}}
        </a>
        <div class="clearfix"></div>
    </div>
     <div class="Clear"></div>
</div>
