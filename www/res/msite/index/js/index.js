// Index data
var index_data;
var banners_data;
var located;
var current_cityid = 3360;  //Default City id
var BoutiqueCase_data;
var live_data;
var companys_data;


//Show a Picture in Weibo Page
function weiboImage() {
    var weibo_img = $("#weibo-pc");
    var child = $("body").children();
    $(child).hide();
    $(weibo_img).show();
}

//Get Activity Data
function getIndex() {
    $.ajax({
        type: "POST",
        url: "index.php?m=wap&f=index&v=index",
        dataType: "json",
        timeout: 3000,
        success: function (data) {
            if (data.code == 1) {
                //console.log(data);
                index_data = data.data;
                located = data.data.init.ktcity;


                //solveTemplate("#active-list", "#index-active-template", index_data);
                solveTemplate("#choose-city", "#index-located-template", located);

                cityBindEvent();
                setCurrentCity();

            }
        },
        error: function (XMLHttpRequest, textStatus) {
            if (textStatus == "timeout") {
                reLoad("body");
            }
        }
    });
}

//Set city_id
function setCurrentCity() {
    var city_id;
    if (getUrlParameter('cityid')) {
        city_id = getUrlParameter('cityid');
    } else if (getCookie("cityid")) {
        city_id = getCookie("cityid");
    } else {
        city_id = 3360;
    }
    getBanners(city_id);
    var cityname = getCityName(city_id);
    $("#current-city").html(cityname);

    selectCurrentCity(cityname);
    getBoutiqueCase(city_id);
    //公司
    getCompany(city_id);

    //精品案例
    resetUrl('#cases-list', city_id);
    //更多案例
    resetUrl('#more-cases', city_id);
    //更多公司
    resetUrl('#more-companys', city_id);

    //找公司
    resetUrl('#find-company', city_id);
}

//Get Banners Data
function getBanners(city_id) {
    $.ajax({
        type: "POST",
        url: "index.php?m=wap&f=index&v=shuffl_photo&shuffl=" + city_id,
        dataType: "json",
        timeout: 3000,
        success: function (data) {
            banners_data = data.data;
            solveTemplate("#banner-box", "#index-banner-template", banners_data);
            //initialize swiper when document ready
            var swiper = new Swiper('#index-banner', {
                pagination: '.swiper-pagination',
                loop: true,
                autoplay: 3000,
                paginationClickable: false,
                autoplayDisableOnInteraction: false
            });
        },
        error: function (XMLHttpRequest, textStatus) {
            if (textStatus == "timeout") {
                reLoad("body");
            }
        }
    });
}

//Set located by GPS
function setLocation() {

    $("#location").addClass("slideIn");

    var city_id = getCookie("cityid");
    if (city_id) {
        var cityname = getCityName(city_id);
        //$("#local-city").html(cityname);

        //2016-09-21优化 s
        //selectCurrentCity(cityname);
        //2016-09-21优化 e
    }

    $("#local-state").html("定位中...");

    var options = {
        enableHighAccuracy: true,
        maximumAge: 1000
    }
    if (navigator.geolocation) {
        //Support geolocation
        //alert("打开GPS");
        navigator.geolocation.getCurrentPosition(locatedSuccess, locatedError);

    } else {
        //Not Support geolocationn
        $("#local-state").html("定位失败，请手动选择城市");
    }


}

//Get Location Success
function locatedSuccess(position) {
    //alert("位置获取成功");
    var longitude = position.coords.longitude;
    var latitude = position.coords.latitude;
    //alert("x:"+longitude+" y:"+latitude);

    $.ajax({
        type: "POST",
        url: "index.php?m=wap&f=index&v=locationByGPS&lng=" + longitude + "&lat=" + latitude,
        dataType: "json",
        timeout: 3000,
        success: function (gps) {
            if (gps.data.cityid) {
                $("#local-city").html(gps.data.city);
                $("#local-state").html("");
                //2016-09-21优化 s
                //selectCurrentCity(gps.data.city);
                //2016-09-21优化 e
                postCity(gps.data.cityid, gps.data.city);
            }
            else {
                $("#local-city").html(gps.data.city);
                $("#local-state").html("暂未开通服务");
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            $("#local-state").html("定位失败，请手动选择城市");
        }
    });
}


//Get Location Error
function locatedError(error) {
    $("#local-state").html("定位失败，请手动选择城市");
//   switch(error.code){
//	   case 1:
//	   alert("位置服务被拒绝");
//	   setDefultCity();
//	   break;
//
//	   case 2:
//	   alert("暂时获取不到位置信息");
//	   setDefultCity();
//	   break;
//
//	   case 3:
//	   alert("获取信息超时");
//	   setDefultCity();
//	   break;
//
//	   case 4:
//	   alert("未知错误");
//	   setDefultCity();
//	   break;
//   }

}

//Selected Current City
function selectCurrentCity(cityname) {
    var cityli = $("#choose-city li");
    $(cityli).removeClass("current");
    for (var i = 0; i < cityli.length; i++) {
        var cityitem = $(cityli).eq(i);
        if ($(cityitem).html() == cityname) {
            $(cityitem).addClass("current");
            return;
        }
    }
    $(cityli).eq(0).addClass("current");
}

//SetDefultCity
function setDefultCity() {
    current_cityid = 3360;
    getBanners(3360);
    $("#current-city").html("北京");
}

//Citys buttons Bind Click
function cityBindEvent() {
    $("#choose-city li").bind("click", function () {
        var choosed = $(this).attr("city-id");
        //url后增加城市参数
        var protocol = window.location.protocol;
        var url = window.location.host;
        window.location.href = protocol + '//' + url + '/mobile-index.html?cityid=' + choosed;


        var choosed_name = $(this).html();
        postCity(choosed, choosed_name, true);
    })
}

//Save Located to Cookie
function postCity(cityid, cityname, reloadpage) {
    $.ajax({
        type: "POST",
        url: "index.php?m=wap&f=index&v=qhcspi&cityid=" + cityid + "&cityname=" + cityname,
        dataType: "json",
        timeout: 3000,
        success: function (data) {
            console.log("success");
            if (reloadpage) {
                window.location.reload();
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            console.log("false");
        }
    });
}

//Id Transform to CityName
function getCityName(cityid) {
    var citys = index_data.init.ktcity;
    for (var key in citys) {
        var city = {
            name: citys[key].city,
            id: citys[key].cityid
        };
        if (city.id == cityid) {
            return city.name;
        }
    }
    return "北京";
}

// get source
function getSource(el) {
    var source = $(el).prev().html();
    var href = $(el).attr("href");
    if (browser.versions.weixin) {
        $(el).attr("href", href + "&id=M微信-首页" + source);
    } else if (browser.versions.weibo) {
        $(el).attr("href", href + "&id=M微博-首页" + source);
    } else {
        $(el).attr("href", href + "&id=M-首页" + source);
    }
}

function getIndexSource() {
    if (browser.versions.weixin) {
        $("#source").val("微信-首页-报名");
    } else if (browser.versions.weibo) {
        $("#source").val("微博-首页-报名");
    } else {
        $("#source").val("M站-首页-报名");
    }
}

//2.1新增start
//装修案例
function getBoutiqueCase(city_id) {
    $.ajax({
        type: "POST",
        url: "index.php?m=wap&f=index&v=tjw_picture&cityid=" + city_id,
        dataType: "json",
        timeout: 3000,
        success: function (data) {
            if (data.code == 1) {
                console.log(data);
                BoutiqueCase_data = data.data;
                solveTemplate("#active-list", "#index-active-template", BoutiqueCase_data);
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            if (textStatus == "timeout") {
                reLoad("body");
            }
        }
    });
}

//工地直播
function getLiveMassgee() {
    $.ajax({
        type: "POST",
        url: "index.php?m=wap&f=index&v=tuijian_log",
        dataType: "json",
        timeout: 3000,
        success: function (data) {
            if (data.code == 1) {
                console.log(data);
                live_data = data.data;
                //BoutiqueCase_data = data.data;
                solveTemplate("#in_live_list", "#in_live_list_template", live_data);
                scaleImgLive();
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            if (textStatus == "timeout") {
                reLoad("body");
            }
        }
    });
}

//口碑公司
function getCompany(city_id) {
    var cityid = city_id;
    $.ajax({
        type: "POST",
        url: "index.php?m=wap&f=index&v=tjw_company&cityid=" + cityid,
        dataType: "json",
        timeout: 3000,
        success: function (data) {
            if (data.code == 1) {
                console.log(data);
                companys_data = data.data;
                solveTemplate("#in_company_list", "#in_company_data", companys_data);
            }
        },
        error: function (XMLHttpRequest, textStatus) {
            if (textStatus == "timeout") {
                reLoad("body");
            }
        }
    });
}

// scale image
function scaleImgLive() {
    var imgs = $(".in_live_list img");
    var boxW = imgs.parent().width(); //区域宽度
    var boxH = imgs.parent().height(); //区域高度
    var ratio = boxW / boxH;
    for (var i = 0; i < imgs.length; i++) {
        imgs[i].onload = function () {
            var img = new Image();
            img.src = this.src;
            var imgW = img.width;
            var imgH = img.height;
            var imgRatio = imgW / imgH;
            if (ratio > imgRatio) {
                var height_t = -((boxW / imgW) * imgH - boxH) / 2;
                this.style.height = "auto";
                this.style.marginTop = height_t + "px";
                this.style.width = '100%';
            } else {
                var width_w = -((boxH / imgH) * imgW - boxW) / 2;
                this.style.width = "auto";
                this.style.marginLeft = width_w + "px";
                this.style.height = '100%';
            }
        };
    }
}


// scale image
function scaleImgCenter(imgs) {
    for (var i = 0; i < imgs.length; i++) {
        (function (i) {
            var img = new Image();
            img.src = imgs[i].src;
            var _this = imgs[i];
            img.onload = function () {
                function getImgAttribute(){
                    var boxW = parseFloat($(_this).parent().css('width').match(/\d+/g)); //鍖哄煙瀹藉害
                    var boxH = parseFloat($(_this).parent().css('height').match(/\d+/g)); //鍖哄煙楂樺害
                    var img = new Image();
                    img.src = _this.src;
                    var imgW = img.width;
                    var imgH = img.height;

                    var imgleft = -(boxH * imgW / imgH - boxW) / 2;
                    var imgtop = -(boxW * imgH / imgW - boxH) / 2;

                    console.log(boxW+'  '+boxH+' imgwidthheight '+imgW+'---'+imgH+' marginlefttop '+imgleft+'---'+imgtop);
                    return {
                        left:imgleft,
                        top:imgtop,
                        imgw:imgW,
                        imgh:imgH,
                        boxw:boxW,
                        boxh:boxH
                    }
                }
                var imgAttr = getImgAttribute();
                if(imgAttr.imgw < 50)return false;
                if (imgAttr.imgw > imgAttr.imgh) {
                    _this.style.height = '100%';
                    _this.style.marginLeft = imgAttr.left + 'px';
                } else {
                    _this.style.width = '100%';
                    _this.style.marginTop = imgAttr.top + 'px';
                }
            };
        })(i);
    }
}
//2.1新增end

// 套餐
function getMealListData() {
    $.ajax({
        url:'index.php?m=wap&f=package&v=package_good',
        type:"post",
        dataType:'json',
        success:function (data) {
            console.log(data)
            solveTemplate('#meal-content','#meal-list-template',data);
            scaleImgCenter($('.meal_cont img'));
        },
        error:function (err) {
            console.log(err);
        }
    });
}
//案例、公司链接修改
function resetUrl(elId, urlId) {
    var href = $(elId).attr('href') + '?cityid=' + urlId;
    $(elId).attr('href', href);
}

$(function () {
    if (winW == 940) {        //If Weibo PC
        weiboImage();
    }
    $("#user-name").unbind("focus");

    //Post application
    getIndex();

    //Bind button Events
    $("#local").bind("click", setLocation);
    $("#close-citys").bind("click", function () {
        $("#location").removeClass("slideIn");
    });

    $(document).on('click', '#layer-close', function () {
        $(".amount_house_mask_bs").hide();
        $(".in_info_bs").hide();
    });

    getIndexSource();

    getSource("#specail-service");
    //工地直播
    getLiveMassgee();

    //装修套餐
    getMealListData();
});