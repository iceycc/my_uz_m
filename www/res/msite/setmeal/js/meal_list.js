(function () {
    // get list data param
    var getDataParam = {
        "page":1,
        "product_type":0,
        "money":0
    }

    // add Prompt text
    var prompt = {
        "end" : "到底了，到底了，到底了，很重要，说三遍！",
        "none" : "小主，您选的条件暂时还没有开放活动哦！"
    }

    // list load state
    var getDataState = true;

    // get trem list data
    function getTremList() {
        $.ajax({
            url:'index.php?m=wap&f=package&v=package_condition',
            type:"post",
            dataType:'json',
            success:function (data) {
                //console.log(data)
                solveTemplate('#term-content','#trem-template',data);
            },
            error:function (err) {
                console.log(err);
            }
        });
    }

    // get meal list
    function getListData(state) {
        state = state || "end";
        $.ajax({
            url:'index.php?m=wap&f=package&v=package_list',
            type:"post",
            dataType:'json',
            data:getDataParam,
            success:function (data) {
                console.log(data)
                if(data.code == 1){
                    $('.meal_mode').append('<div class="prompt_text">'+prompt[state]+'</div>');
                    return false;
                }
                // new page box
                var pageCont = $('<ul class="meal_cont" id="page'+getDataParam.page+'"></ul>')

                // new page box template
                solveTemplate(pageCont,'#meal-list-template',data);

                // new page move list conetnt
                $('.meal_mode').append(pageCont);

                // image  load
                $('.meal_mode .meal_top_img img').imageLoad();

                // set img size
                scaleImg($('.meal_mode .meal_top_img img'));

                // is load state
                getDataState = true;
            },
            error:function (err) {
                console.log(err);
            }
        });
    }

    // close trem
    function closeTrem() {
        $('.term').removeClass('on');
        $('#shaixuan-minu').removeClass('toggleClick-active');
    }

    // trem operate
    function tremOperate() {
        // trem minu table
        $('#shaixuan-minu').toggleclick(function () {
            $('.term').addClass('on');
        },function () {
            $('.term').removeClass('on');
        });

        // trem close
        $('.term').on('click','.term_close',closeTrem);

        // term minu select
        $('.term ').on('click','.term_minu',function () {
            $(this).addClass('active').siblings('.term_minu').removeClass('active');
            var genreType = $(this).parents('.trem_mode').attr('type');
            var minuType = $(this).attr('type');
            getDataParam[genreType] = minuType;
            //console.log(getDataParam)
        });

        // trem sibmit
        $('.term').on('click','.term_sibmit',function () {
            $('.meal_mode').html('');
            getDataParam.page = 1;
            getListData('none');
            closeTrem();
        });

        // window scroll test scroll height
        $(window).on('scroll',function () {
            // meal content height
            // var mealHeight = $('.meal_mode').height();
            // window height
            // var Win_height = $(window).height()
            // scroll height
            // var scroll_H = getScrollTop();

            // page height small window height
            if($('.meal_mode').height() < $(window).height())return false;

            // move page down state
            var scrollState = $('.meal_mode').height()-500 < $(window).height() + getScrollTop();

            // move page down & load state true
            if(scrollState && getDataState){
                getDataState = false;
                getDataParam.page += 1;
                getListData();
            }
        });
    }

    $(function () {
        // trem operate
        tremOperate();

        // get trem list data
        getTremList();

        // get meal list
        getListData();
    });
})();