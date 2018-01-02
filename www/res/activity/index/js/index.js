(function () {

    // app can url log in
    function useUrlLogIn() {
        var UID = getUrlParameter('uid');
        if (!UID) {
            LoadMathed();
        } else {
            $.ajax({
                type: "post",
                url: "/index.php?m=zx_recommended&f=index&v=tj_status&uid=" + UID,
                dataType: "json",
                timeout: 3000,
                success: function (res) {
                    if (!res.code)return false;
                    LoadMathed();
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    }

    // mine Page
    function openMine() {
        testLogIn({
            success: function () {
                window.location.href = 'activity-userhome.html';
            },
            error: function () {
                alertConfirm({
                    "str": "登录后查看",
                    "right": '<span class="color_org">去登录</span>',
                    "error": '<span class="color_999">取消</span>',
                    "url": "activity-login.html?favored=1"
                });
            }
        });
    }

    // Recommend minu click
    function recommendMore() {
        testLogIn({
            success: function () {
                window.location.href = 'activity-index_main.html';
            },
            error: function () {
                alertConfirm({
                    "str": "登录后才能推荐",
                    "right": '<span class="color_org">去登录</span>',
                    "error": '<span class="color_999">取消</span>',
                    "url": "activity-login.html"
                });
            }
        });
    }
    // load success
    function LoadMathed() {
        history.replaceState(null, '', 'http://' + location.host + location.pathname);

        //立即推荐
        $('.tj_minu').on('click',recommendMore);

        // 我的
        $('.header_rightminu').on('touchstart', openMine);
    }

    // test log way
    function checkSource() {
        var UID_STATE = getCookie('tj_id');
        if (UID_STATE != '' && UID_STATE) {
            // 已登录
            LoadMathed();
        } else {
            // 未登录
            useUrlLogIn();
        }
    }

    $(function () {
        checkSource();
    });
})();