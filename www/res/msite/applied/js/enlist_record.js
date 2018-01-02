
var pageType = getUrlParameter("type");
var pageId = getUrlParameter("page_id");

// meathed select
function setContent(pageType) {
    //boutique精品案例
    //works预约公司
    //steward预约管家
    //designer预约设计师
    //taocan 套餐
    switch (pageType) {
        case 'boutique':
            getMessage(function (res) {
                var data = res.data;
                setmassage(data);
                $('#applyBtn').val(data.titie);
                $('#apply-img').attr('src', data.cover);
                $('.think-banner').attr({'id': 'think-banner'});

            });
            break;
        case 'works':
            getMessage(function (res) {
                var data = res.data;
                setmassage(data);
                $('.target_username').html(data.name);
                $('#apply-img').attr('src', './res/msite/applied/images/firm_banner_bg.jpg');
                $('.target_logo img').attr('src', data.thumb);
                $('.think-banner').attr({'id': 'firm-banner'});
            });
            break;
        case 'steward':
            getMessage(function (res) {
                var data = res.data;
                setmassage(data);
                //console.log(data)
                $('.target_username').html(data.name);
                $('.steward_level').html(data.level);
                $('#apply-img').attr('src', './res/msite/applied/images/butler_banner_bg.jpg');
                $('.target_logo img').attr('src', data.personalphoto);
                $('.think-banner').attr({'id': 'butler-banner'});
            });
            break;
        case 'designer':
            getMessage(function (res) {
                var data = res.data;
                setmassage(data);
                $('.target_username').html(data.name);
                $('.target_message_design_lv').html(data.ranks);
                $('#apply-img').attr('src', './res/msite/applied/images/design_banner_bg.jpg');
                $('.think-banner').attr({'id': 'designer-banner'});
                $('.target_logo img').attr('src', data.thumb);
            });
            break;
        case 'taocan':
            getMessage(function (res) {
                var data = res.data;
                setmassage(data);
                $('#think-banner').remove();
                $('#apply-form').css('padding-top', '0.5rem');
            });
            break;
    }
}

// get data
function getMessage(fn) {
    var DATA = {
        "temp": pageId,
        "type": pageType
    };
    var packageId = getUrlParameter("id");
    if (pageType == 'taocan') {
        DATA.package_id = packageId;
    }
    $.ajax({
        type: "post",
        url: "api/subscribe.php?action=subscribe",
        data: DATA,
        dataType: "json",
        success: function (res) {
            console.log(res);
            fn && fn(res);
            $('.steward_level').css('margin-left', -$('.steward_level').width() / 2);
        },
        error: function () {
            console.log('您当前网络异常');
        }
    });
}

// set content
function setmassage(data) {
    $('#userTotal').html(data.fbcount);
    $('header .header-title').html(data.titie);
    $('#applyBtn').val('预约');
}


function singCallBackSuccess() {
    setContent(pageType);
}

$(function () {
    //getMessage(DATA)
    setContent(pageType);

});
