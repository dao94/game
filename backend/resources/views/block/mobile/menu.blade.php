<style>
    #navbar{
        background: #E91B1B;
    }
    #menu-mobile .navbar {
        background: #E91B1B;
    }
</style>
<div id="menu-mobile">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Menu</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a title="Trang chủ" href="{{url()}}">Trang chủ</a></li>
                    <li><a href="{{url()}}/gioi-thieu">Giới thiệu</a></li>
                    <li><a href="{{url()}}/tin-tuc">Tin tức</a></li>
                    <li><a href="{{url()}}/lien-he">Liên hệ</a></li>
                </ul>               
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
</div>