var questionExpMas;
var case_id = getUrlParameter("id");
function questionExp(){
    $.ajax({
        url:"/api/housekeeper.php?action=questionDetails",
        data:{
            "id":case_id
        },
        dataType:"json",
        success:function(res){
            console.log(res);
            if(!res.code)return;

            questionExpMas = res.data;
            solveTemplate("#wd_cont", "#question-details-template", questionExpMas);
            general({
                'content':'.wd_reply_r_text',
                'btn':'.reply_more_btn',
                'number':50
            });
        },
        error: function(XMLHttpRequest, textStatus){
            if(textStatus == "timeout"){
                reLoad("body");
            }
        }
    });
}
//查看更多收方
/*
 **	general 		检测是否显示查看更多
 ** 	parmas
 ** 		json
 **                 'content':content class
 **                 'btn':button class
 **                 'number': show content length
 */
function general(json){
    $(json.content).each(function(index,ele){
        var _thisOldHtml = $(this).html();
        var _thisHtmlLength = $(this).html().length;
        if(_thisHtmlLength > json.number){
            $('.reply_more_btn').eq(index).show();
            $("<em>"+_thisOldHtml+"</em>").hide().appendTo($(this).siblings('.wd_reply_r_foot'));
            var newText = _thisOldHtml.substr(0, json.number)+"...";
            $(this).html(newText);
        }
    });

    //查看全文按钮
    $(json.btn).on('touchstart',function(){
        var oldHtml = $(this).siblings('em').html();
        var btnHtml = $(this).html();
        var newHtml = oldHtml.substr(0, json.number)+"...";
        switch (btnHtml){
            case '收起':
                $(this).parent().siblings('.wd_reply_r_text').html(newHtml);
                $(this).html('查看全文');
                break;
            case '查看全文':
                $(this).parent().siblings('.wd_reply_r_text').html(oldHtml);
                $(this).html('收起');
                break;
        }
    });
}

$(function(){
    //检测是否安卓 安卓隐藏诸葛装修
    if(browser.versions.android){
        $('.footer_zhuge').hide();
        $('body').css({'padding-bottom':0});
    }

    questionExp();
    $('.footer_zhuge_close').on('touchstart',function(){
        $(this).parents('.footer_zhuge').css({"bottom":'-3.65rem'});
        $('body').animate({'padding-bottom':0},1000);
        return false;
    });
});

$(function(){
    //var zanNum = 0;
    $(document).on('touchstart','.answer_time_zan',function(){
        var _this = $(this);

        var zannumber = $(this).attr('number');
        zannumber++;
        $(this).attr({'number':zannumber});
        var zanStatus = zannumber%2;

        var answerId = $(this).attr('zanid');
        //var $this = $(this);
        //console.log(answerId);
        $.ajax({
            type: "POST",
            url: "/api/housekeeper.php?action=laud&id="+answerId+"&laudstatus="+zanStatus,
            dataType: "json",
            success: function (res) {
                //console.log(res);
                var data = res.data;
                if(res.code == 1){
                    //zanNum = 0;
                    _this.find('i').addClass('zan1');
                    _this.find('span').html(data.answer_laud);
                    _this.css({'color':'#ff7519'});
                }else{
                    //zanNum = 1;
                    _this.find('i').removeClass('zan1');
                    _this.find('span').html(data.answer_laud);
                    _this.css({'color':'#999999'});
                }
            },
            error: function () {
                alert("找不到数据辣，请稍后再试~");
            }
        });
    });
});