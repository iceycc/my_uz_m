"use strict";
var user_promlist;
var UID = getUrlParameter('id');
console.log(UID)
//Get promote Data
function getPromList() {
    $.ajax({
        type: "POST",
        url: "index.php?m=zx_recommended&f=extract_money&v=friend_detail&uid="+UID,
        dataType: "json",
        timeout: 3000,
        success: function(data){
            if(!data.code)return false;
            if(data.data.sex == 1){
                data.data.sex = "先生";
            }else if(data.data.sex == 2){
                data.data.sex = "女士";
            }
            user_promlist = data.data;
            console.log(user_promlist);
            solveTemplate("#us-name-title", "#user-title-template", user_promlist);
            solveTemplate("#user-promlist", "#user-promlist-template", user_promlist);

        },
        error: function(XMLHttpRequest, textStatus){
            if(textStatus == "timeout"){
                reLoad("body");
            }
        }
    });
}

$(function(){
    getPromList();
});