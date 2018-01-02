var NODE_ID = getUrlParameter('nodeid');
var ORDER_ID = getUrlParameter('orderid');
var UP_DATA = getUrlParameter('upda');
var GO_SOURE =  getUrlParameter('gosoure');
var starListData;
var starMassage;
var StarStatus = ['非常差', '差', '一般', '好', '非常好'];
//评价列表
function getStarList(){
    $.ajax({
        type: "POST",
        url: "/index.php?m=wap&f=member_lognew&v=list_graded",
        data:{
            'orderid':ORDER_ID
        },
        dataType: "json",
        timeout: 3000,
        success: function (res) {
            console.log(res);
            starListData = res.data;
            solveTemplate("#score_cont", "#score_starlist_templete", starListData);
            addStarNum(starListData);
        },
        error: function (XMLHttpRequest, textStatus) {
            console.log(XMLHttpRequest)
        }
    });
}

//单个详情
function getStarStem(){
    $.ajax({
        type: "POST",
        url: "/index.php?m=wap&f=member_lognew&v=detail_graded",
        data:{
            'orderid':ORDER_ID,
            'nodeid':NODE_ID
        },
        dataType: "json",
        timeout: 3000,
        success: function (res) {
            console.log(res);
            starListData = res.data;
            //console.log(starListData);
            //console.log(starListData)
            solveTemplate("#score_cont","#score_starlist_templete", starListData);
            addStarNum(starListData);
            if(starListData[0] && starListData[0].content){
                $('.scor_texta').val(starListData[0].content);
            }

        },
        error: function (XMLHttpRequest, textStatus) {
            console.log(XMLHttpRequest)
        }
    });
}

// 提交评分
function sendStarData(DATA,_this){
    $.ajax({
        type: "POST",
        url: "/index.php?m=wap&f=member_lognew&v=write_score",
        data:DATA,
        dataType: "json",
        timeout: 3000,
        success: function (res) {
            console.log(res);
            if(NODE_ID){
                switch (parseInt(GO_SOURE)){
                    case 1:
                        window.location.href = 'mobile-pay_page.html?order_id='+ORDER_ID;
                        break;
                    case 2:
                        window.location.href = 'mobile-mysite.html?live_id='+ORDER_ID;
                        break;
                    case 3:
                        window.location.href = 'mobile-user_home.html';
                        break;
                    default:
                        goBack();
                        break;
                }

            }else{
                //列表
                var scoreSize = $('.scores').size();
                if(scoreSize > 1){
                    if(_this){
                        _this.parents('.scores').remove();
                        showTip('评价成功');
                    }
                }else{
                    showTip('评价成功');
                    setTimeout(function(){
                        window.location.href = 'mobile-user_home.html';
                    },2000);
                }
            }

        },
        error: function (XMLHttpRequest, textStatus) {
            console.log(XMLHttpRequest)
        }
    });
}
//add Star
function addStarNum(){
    $('.start_cont').each(function(){
        var this_res = $(this).attr('number');
        if(this_res > 0){
            $(this).siblings('.start_num').html(StarStatus[parseInt(this_res)-1]).removeClass('color_red');
        }
        $(this).find('.iconfont').each(function(ind,el){
            if(ind <　this_res){
                $(el).removeClass('icon-star_one').addClass('icon-star_two color_red');
            }
        });
    });
}

//评价操作
function operationStar(){

    var nodeName = 'node'+$(this).parents('.scores').find('.scoreSendId .nodeid').val();
    starMassage = {};

    //  提示框
    var shadowTimer;
    function addShadow(){
        var _this = $(this);
        $(this).parents('.scores').addClass('hint');
        clearInterval(shadowTimer);

        shadowTimer = setInterval(function(){
            $(_this).parents('.scores').removeClass('hint');
        },2000);
    }

    //
    function checkScores() {
        var scoreStatus = true;
        var _this = $(this);
        //是否录入数据状态
        var starNumStatus = $(this).parents('.scores').find('.outcome');

        //检测当前数据是否录入完成
        starNumStatus.each(function(){
            var thisStarNum = $(this).attr('number');

            if(parseFloat(thisStarNum) == 0){
                scoreStatus = false;
                showTip('您的意见非常宝贵，请对该项所有选项评价，谢谢！');
                addShadow.call(_this);
                return false;
            }
        });

        var CONTENT = $(this).parents('.scores').find('.scor_texta').val();
        //console.log()
        // if(CONTENT == ''){
        //     testaState = false;
        //     showTip('您的意见非常宝贵，请对该项所有选项评价，谢谢！');
        //     addShadow.call(_this);
        // }

        // if(testaState && starListState){
        //     scoreStatus = true;
        //
        //     return scoreStatus;
        // }else{
        //     scoreStatus = false;
        //
        //     return scoreStatus;
        // }
        return scoreStatus;


    }

    // 选择星星
    $('.score_contentlist').on('click','.start_cont .iconfont', function () {
        var starIndex = $(this).index();
        var starName = $(this).parent().attr('name');
        var nodeName = 'node'+$(this).parents('.scores').find('.scoreSendId .nodeid').val();

        //添加评分数据
        if(starMassage[nodeName]){
            starMassage[nodeName][starName] = parseInt(starIndex)+1;
            $(this).parents('.outcome').attr({'starnum':1,'number':parseInt(starIndex)+1});
        }else{
            starMassage[nodeName] = {};
            starMassage[nodeName][starName] = parseInt(starIndex)+1;
            $(this).parents('.outcome').attr({'starnum':1,'number':parseInt(starIndex)+1});
        }

        //清除之前选择状态
        $(this).siblings().removeClass('icon-star_two color_red').addClass('icon-star_one');
        $(this).parent().siblings('.start_num').html(StarStatus[starIndex]).removeClass('color_red');

        //添加当前选择状态
        $(this).parent().find('.iconfont').each(function (index, ele) {
            if (index <= starIndex) {
                $(ele).removeClass('icon-star_one').addClass('icon-star_two color_red');
            }
        });
    });

    // 提交评价
    $('.score_content').on('click','.submit_score',function(){
        var CheckStatus = checkScores.call(this);
        //console.log(CheckStatus,1)
        var nodeName = 'node'+$(this).parents('.scores').find('.scoreSendId .nodeid').val();
        if(CheckStatus){
            // 合并参数内容
            cancatData.call(this);
            //列表 or 详情
            sendStarData(starMassage[nodeName],$(this));
            //console.log('chengong')
        }

    });
}

//hebing data
function cancatData(){
    // this 为.score_content .submit_score

    var dataJsonName = 'node'+$(this).parents('.scores').find('.scoreSendId .nodeid').val();
    //console.log(dataJsonName)
    $(this).parents('.scores').find('.scoreSendId input').each(function(){
        var dataListName = $(this).attr('sendname');
        //console.log(dataListName)
        if(starMassage[dataJsonName]){
            starMassage[dataJsonName][dataListName] = $(this).val();
        }else{
            starMassage[dataJsonName]={};
            starMassage[dataJsonName][dataListName] = $(this).val();
        }

    });
    starMassage[dataJsonName]["content"] = $(this).parents('.scores').find('.scor_texta').val();

    if(UP_DATA){
        $(this).parents('.scores').find('.outcome').each(function(){
            //console.log(this);
            var dataListName = $(this).attr('name');
            var dataListNumber = $(this).attr('number');
            //console.log(dataListName)
            if(starMassage[dataJsonName]){
                starMassage[dataJsonName][dataListName] = dataListNumber;
            }else{
                starMassage[dataJsonName] = {};
                starMassage[dataJsonName][dataListName] = dataListNumber;
            }

        });
        starMassage[dataJsonName]["upda"] = 1;
        starMassage[dataJsonName]["modification_num"] = 1;
        starMassage[dataJsonName]["additional"] = starListData[0].additional;

    }
    console.log(starMassage)




}


$(function () {

    if(NODE_ID){
        getStarStem();
    }else{
        getStarList();
    }

    operationStar();






});