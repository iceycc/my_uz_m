var mySiteData;
var nodeLogo = {
    "10": "iconfont icon-yuyueliangfangs",
    "11": "iconfont icon-liangfang",
    "12": "iconfont icon-dingdanshenhes",
    "15": "iconfont icon-yixiangdingjins",
    "17": "iconfont icon-yujiaodiss",
    "19": "iconfont icon-qiandingsanfanghetongs",
    "21": "iconfont icon-kaigongyishis",
    "25": "iconfont icon-shuidianyanshous",
    "27": "iconfont icon-shuidiangcyanshous",
    "29": "iconfont icon-wamuyanshous",
    "28": "iconfont icon-fangshuigcyanshous",
    "31": "iconfont icon-wamugongchengyanshous",
    "33": "iconfont icon-youqicailiaoyanshous",
    "35": "iconfont icon-youqiyanshous",
    "36": "iconfont icon-anzhuangyanshous",
    "37": "iconfont icon-jungongs",
    "39": "iconfont icon-huanbaojiances",
    "45": "iconfont icon-weibaoss",
    "43": "iconfont icon-dablebaojiances",
    "49": "iconfont icon-huanbaozhiliss",
    "51": "iconfont icon-huanbaozhilifuces",
    "1": "iconfont icon-dingdanshenhes",
    "0": "iconfont icon-dingdanshenhes",
    "2": "iconfont icon-jingxuangongsis",
    "9": "iconfont icon-zhidingguanjias"
}
function getMySiteList(){
    $.ajax({
        type: "POST",
        url: "/index.php?m=wap&f=member_lognew&v=log_list",
        dataType: "json",
        timeout: 3000,
        success: function (res) {
            console.log(res);
            if(res.code == 0) {
                var p = '<p style="text-align: center;padding-top: 3rem;font-size: 0.875rem;">'+res.message+'</p>';
                $('body').append(p);
            }
            mySiteData = res.data
            solveTemplate("#list_cont","#mysite_list_templete" , mySiteData);
        },
        error: function (XMLHttpRequest, textStatus) {
            if(textStatus == "timeout"){
                reLoad("body");
            }
        }
    });
}

$(function(){
    getMySiteList();
});