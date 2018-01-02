"use strict";
var user_promote;
var UID = getCookie('tj_id');

//Get promote Data
function getPromote() {
    $.ajax({
        type: "POST",
        url: "index.php?m=zx_recommended&f=extract_money&v=recommend&uid="+UID,
        dataType: "json",
        timeout: 3000,
        success: function(data){
            if(!data.code)return false;
            user_promote = data.data;
            console.log(data);
            solveTemplate("#user-promote", "#user-promote-template", user_promote);

        },
        error: function(XMLHttpRequest, textStatus){
            if(textStatus == "timeout"){
                reLoad("body");
            }
        }
    });
}

$(function(){
    getPromote();
});