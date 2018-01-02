var case_id = getUrlParameter("id");
var questionListMas;
//list masage
function questionList(){
    $.ajax({
        url:"/api/housekeeper.php?action=questionlst",
        data:{
            "uid":case_id
        },
        dataType:"json",
        success:function(res){
            console.log(res);
            if(!res.code)return;
            $('header .header-title').html(res.data.gjname+'回答的问题');
            questionListMas = res.data.question;
            solveTemplate("#question_box", "#question-list-template", questionListMas);
        },
        error: function(XMLHttpRequest, textStatus){
            if(textStatus == "timeout"){
                reLoad("body");
            }
        }
    });
}
$(function(){
    //检测是否安卓 安卓隐藏诸葛装修
    if(browser.versions.android){
        $('.footer_zhuge').hide();
        $('body').css({'padding-bottom':0});
    }
    questionList();
    $('.footer_zhuge_close').on('touchstart',function(){
        $(this).parents('.footer_zhuge').css({"bottom":'-3.65rem'});
        $('body').animate({'padding-bottom':0},1000);
        return false;
    });
});