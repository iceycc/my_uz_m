"use strict";
var friend_data;
var UID = getCookie('tj_id');

//Get promote Data
function getPromote() {
    $.ajax({
        type: "POST",
        url: "index.php?m=zx_recommended&f=extract_money&v=friend&uid="+UID,
        dataType: "json",
        timeout: 3000,
        success: function(data){
            if(!data.code)return false;
            friend_data = data.data;
            console.log(data);
            solveTemplate("#friend-list", "#friend-list-template", friend_data);

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