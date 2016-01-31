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