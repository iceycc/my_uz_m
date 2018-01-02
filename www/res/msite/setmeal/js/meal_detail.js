(function () {
    var PAGE_ID = getUrlParameter('id');
    console.log(1)
    //banner silder
    function bannerSilder() {
        var swiper = new Swiper('.banner', {
            pagination: '.swiper-pagination',
            loop: true,
            autoplay: 3000,
            paginationClickable: false,
            autoplayDisableOnInteraction: false
        });
    }

    // get detail data
    function getDetailData() {
        $.ajax({
            url:'index.php?m=wap&f=package&v=package_detail&id='+PAGE_ID,
            type:"post",           
            dataType:'json',
            
            success:function (data) {
                console.log(data);
                
                
                solveTemplate('#banner-content','#banner-template',data);
                solveTemplate('#meal-content','#meal-content-template',data);
                bannerSilder();

                // set collection icon state
                var data = data.data;
                
                
                setCollectState(data)
                // image  load
                $('.details img').imageLoad();
            },
            error:function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }

    // set collection icon state
    function setCollectState(data) {
        if(data.collect == 0){
            $('.fix_collection .iconfont').addClass('icon-shoucangkongxin').removeClass('icon-shoucangshixin');
            $('.fix_collection span').css('color','#fff');
        }else if(data.collect == 1){
            $('.fix_collection .iconfont').addClass('icon-shoucangshixin').removeClass('icon-shoucangkongxin');
            $('.fix_collection span').css('color','#ff7519');
        }
    }

    // send collection
    function sendCollect() {
        $.ajax({
            url:'index.php?m=wap&f=package&v=collect_package&id='+PAGE_ID,
            type:"post",
            dataType:'json',
            success:function (data) {
                console.log(data);
                if(data.code == 1){
                    alertConfirm('登录后才能收藏哦！')
                    return false;
                }
                // set collection icon state
                setCollectState(data)

            },
            error:function (err) {
                console.log(err);
            }
        });
    }

    $(function () {
        getDetailData();
        $('.fix_collection ').on('click',sendCollect);
        $('.fix_gosing a').attr('href','mobile-ordered.html?page_id=152&type=taocan&id='+getUrlParameter('id'));
    });
})();


