(function ($) {
    $.fn.imageLoad = function () {
        var scrollTop,
            _this = this;

        function getScrollTo() {
            var tops = 0;
            if (document.documentElement.scrollTop) {
                tops = document.documentElement.scrollTop;
            } else {
                tops = document.body.scrollTop;
            }
            return tops;
        }

        $(this).each(function () {
            var load = $(this).attr('load');
            if(!status){
                $(this).attr('load',0);
            }
        });

        function addSrc(){
            //console.log(document.body.scrollTop)
            scrollTop = getScrollTo() + document.documentElement.clientHeight;
            $(_this).each(function () {
                //console.log($(this))
                var status = $(this).attr('load');
                var postionT = $(this).offset().top;
                //console.log(postionT);
                if(status == 0 && postionT < scrollTop){
                    $(this).attr('src',$(this).attr('data-original'));
                    $(this).addClass('fadeIn');
                    $(this).attr('load',1)
                }
            });
        }
        addSrc()
        $(document).on('scroll', function () {
            addSrc();
        });



    };
})(Zepto);
