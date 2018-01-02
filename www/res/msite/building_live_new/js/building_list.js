$(function() {
    goTop();
    getList();
    getSx();
    getSort();
    $(window).bind("scroll", scrollPages);
});
var sortStatus = nodeId = 0;
if(getUrlParameter("status")){
    nodeId = getUrlParameter("status");
}

var isLoading = true, //ajax请求状态
    page = 1,		  //列表页数
    totalPage = 0,	  //总页数
    docH = 0;

function getSx() {
    var sxBtn = $('#shaixuan-link'),
        sxBox = $('#sx-box'),
        sxContent = $('#sx-content'),
        sxBg  = $('#sx-bg');

    sxBtn.bind('click', function() {
        sxBox.toggleClass('slideIn');
        sxBg.toggle();
        sxBg.add(sxContent).bind('touchmove', function(event) {
            event.preventDefault();
        });
    });

    sxBg.bind('click', function() {
        sxBox.removeClass('slideIn');
        sxBg.hide();
    });

    sxContent.find('a').each(function(event){
        var _this = $(this);
        if (_this[0].href == String(window.location)){
            _this.parents('.sx-li').addClass('active-style');
        }
    });
    // sxContent.bind('click', function(event) {
    // 	if(event.target.nodeName == 'LI') {
    // 		nodeId = $(event.target).attr('status');
    // 		$(this).find('li').removeClass('active-style');
    // 		$(event.target).addClass('active-style');
    // 		sxBox.removeClass('slideIn');
    // 		sxBg.hide();
    // 		page = 1;
    // 		$("#list-container .list-ul").remove();
    // 		$(".down-page").show();
    // 		getList();
    // 		$(window).bind("scroll", scrollPages);
    // 	}
    // });
}
function getSort() {
    var newSort = $('#new-sort'),
        maxSort = $('#max-sort');

    newSort.bind('click', function() {
        sortStatus = $(this).attr('status');
        $(this).addClass('active').siblings().removeClass('active');
        page = 1;
        $("#list-container .list-ul").remove();
        $(".down-page").show();
        getList();
        $(window).bind("scroll", scrollPages);
    });

    maxSort.bind('click', function() {
        sortStatus = $(this).attr('status');
        $(this).addClass('active').siblings().removeClass('active');
        page = 1;
        $("#list-container .list-ul").remove();
        $(".down-page").show();
        getList();
        $(window).bind("scroll", scrollPages);
    });
}

function getList() {
    isLoading = false;
    var liveContent = '<ul id=page'+page+' class=list-ul></ul>';
    var reqUrl;
    if(nodeId == 5) {
        reqUrl = "/index.php?m=wap&f=biz_lognew&v=listl&acquiesce="+sortStatus+"&ends="+nodeId+"&page="+page;
    } else {
        reqUrl = "/index.php?m=wap&f=biz_lognew&v=listl&acquiesce="+sortStatus+"&nodeid="+nodeId+"&page="+page;
    }
    $('#list-container').append(liveContent);
    $.ajax({
        type: "POST",
        url: reqUrl,
        dataType: "json",
        timeout: 2000,
        success: function(res) {
            console.log(res)
            if(res && res.code == 1) {
                var data = res.data;
                if(data.page_max) {
                    totalPage = data.page_max;
                }
                console.log(totalPage)
                if(totalPage <= 1){
                    $(".down-page").remove();
                }
                solveTemplate('#page'+page, '#list-data', data);

                scrollBuilding();
                $(".lazy-img").imageLoad();
                //liveImgLoaded();
                scaleImg($('#page'+ page +" .lazy-img"))
                docH = $(document).height();
                isLoading = true;
                page++;


            }
        },
        error: function(XMLHttpRequest, textStatus) {
            console.log(textStatus)
        }
    });
}

function scrollPages() {
    var pageH = $('.down-page').height();
    var sTop = document.body.scrollTop + 200;
    if(pageH + sTop >= docH - winH && isLoading) {
        if(page <= totalPage) {
            getList();
        } else {
            $(".down-page").hide();
        }
    }
}

// 适用于工地直播列表可能出现多图模式
function scaleImg(imgs) {
    for (var i = 0; i < imgs.length; i++) {
        imgs[i].onload = function () {
            var boxW = parseFloat($(this).parent().css('width').match(/\d+/g)); //区域宽度
            var boxH = parseFloat($(this).parent().css('height').match(/\d+/g)); //区域高度
            var img = new Image();
            img.src = this.src;
            var imgW = img.width;
            var imgH = img.height;

            var imgleft = -(boxH * imgW / imgH - boxW) / 2;
            var imgtop = -(boxW * imgH / imgW - boxH) / 2;

            //console.log(boxW+'  '+boxH+' imgwidthheight '+imgW+'---'+imgH+' marginlefttop '+imgleft+'---'+imgtop);
            if (imgW > imgH) {
                this.style.height = '100%';
                this.style.marginLeft = imgleft + 'px';
                var loadImgW = $(this).width();
                if(loadImgW-10 < boxW){
                    this.style.height = 'auto';
                    this.style.marginLeft = 'auto';
                    this.style.width = '100%';
                    this.style.marginTop = imgtop + 'px';
                }
            } else {
                this.style.width = '100%';
                this.style.marginTop = imgtop + 'px';
            }
        };
    }
}
// 工地直播原有图片自适应取中间当前未使用
function liveImgLoaded(){
    $(".lazy-img").bind("imgloaded",function(){
        var that = $(this);
        that.css({
            height: "auto",
            "min-height": "10.1875rem"
        });
        var boxH = $(".building-box").height();
        var boxW = $(".building-box").width();
        var imgW = that.width();
        var imgH = that.height();
        var _imgH=(boxW/imgW)*imgH;

        var height_t = -(_imgH-boxH);
        that.css({
            position: "relative",
            top: height_t/2
        });
        that.next().css("margin-top", height_t);
    });
}

//定位到当前浏览直播
function scrollBuilding(){
    var building_id = getCookie("buildingid");
    $(".list-li").each(function(){
        var this_id = $(this).attr("building-id");
        if(this_id == building_id){
            var headerH = $("header").height();
            var nTop = $(this).offset().top - headerH;
            document.body.scrollTop = nTop;

            document.cookie = "buildingid=null"; //删除cookie
        }
    });

}

;(function(){
    var oRem = document.documentElement.style.fontSize = document.documentElement.clientWidth/320*16+'px';
    window.addEventListener('resize',function(){
        var oRem = document.documentElement.style.fontSize = document.documentElement.clientWidth/320*16+'px';
    },false);
})();
