<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0, minimal-ui"/>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <!--iphone桌面快捷方式图标<link rel="apple-touch-icon" href="custom_icon.png">-->
    <meta charset="utf-8">
    <meta property="qc:admins" content="50304154552051676375" />
    <meta name="keywords" content="装修管家,量房设计,装修施工,材料商城,环保方案,装修服务,装修图库,建材商城,装修攻略、优装网、装修网、优装美家">
    <meta name="description" content="优装美家为您提供免费专业咨询、免费量房、免费设计、免费装修保险、免费环保检测、优装网-专业装修网优选装修公司、优选建材商品、优选装修管家、优选环保服务">
    <title>优装美家—装修计算器</title>
    <link rel="stylesheet" type="text/css" href="<?php echo R;?>msite/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/calculator_new2/css/calculator_new.css" />

<div style="display:none">
    <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "//hm.baidu.com/hm.js?0a9b93e0ac9bdda145e2d4f6ffa88ee5";
      var s = document.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
    <script type="text/javascript">
        var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fb5fdc578640695ab74da0b40389ac54e' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <!-- 信息体系百度代码统计 -->
    <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "//hm.baidu.com/hm.js?0a9b93e0ac9bdda145e2d4f6ffa88ee5";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</div>
</head>

<body id="managerPage" class="bg-f0">
    <div id='share_logo' style='margin:0 auto;display:none;'>
        <img src="<?php echo R;?>msite/calculator_new2/img/jisuanqi.jpg"/>
    </div>
    <header>
        <div class="tit_minu">
        <a id="go-back" target="_self" title="优装美家">
            <i class="iconfont icon-goback"></i>
        </a>
        <a class="back_index" href="mobile-index.html"></a>
    </div>
        <h1 class="header-title">装修计算器</h1>
    </header>
    <!-- Banner S -->
    <div id="calculator-banner">
        <a href="#"><img src="<?php echo R;?>msite/calculator_new2/img/zhuangxiuFirst.jpg" alt="装修要花多少钱，10秒免费获取报价"></a>
    </div>
    <!-- Banner E -->
    <!-- quality S -->
    <section id="quality">
        <div id="apply-form">
            <form name="myform" method="post" id="myform">
                <div class="firstBlackBox">
                   <span class="countPre"></span><span id='count' class="countUpStr">24242</span>
                </div>
                <div id="area-box">
                    <input id="user-area" name="area" class="apply-input" type="" maxlength="10" placeholder="请输入您的建筑面积">
                </div>
                <div id="name-box">
                    <input id="user-name" name="title" class="apply-input" type="text" maxlength="10" placeholder="请输入您的真实姓名">
                </div>
                <div id="phone-box">
                    <input id="user-pwd" name="telephone" class="apply-input" type="tel" maxlength="11" placeholder="填写您的联系方式,轻松获取预算明细">
                </div>
                <div class="user-info fix">
                    <div id="province">
                        <select name="select-01" id="select-01">
                            <option value="0">请选择城市</option>
                        </select>
                    </div>
                </div>
                <div class="area-box">
          <div class="first-box">
            <select name="rooms" id="rooms">
                <option value="1">1室</option>
                <option value="2">2室</option>
                <option value="3">3室</option>
                <option value="4">4室</option>
                <option value="5">5室</option>
            </select>
            <select name="living-room" id="living-room">
                <option value="0">0厅</option>
                <option value="1">1厅</option>
                <option value="2">2厅</option>
            </select>
          </div>
          <div class="second-box">
            <select name="kitchen" id="kitchen">
                <option value="0">0厨</option>
                <option value="1">1厨</option>
            </select>
            <select name="bathroom" id="bathroom">
                <option value="0">0卫</option>
                <option value="1">1卫</option>
                <option value="2">2卫</option>
            </select>
            <select name="balcony" id="balcony">
                <option value="0">0阳台</option>
                <option value="1">1阳台</option>
                <option value="2">2阳台</option>
            </select>
          </div>
                </div>
                <div class="readMeTitle">
                    <input type="checkbox" value="" id="readProtocal" name="" checked ="checked"/><span class="readMe" >我已阅读并且同意优装美家的<a class="divcss5" href="#" >用户协议</a></span>
                </div>
                <input id="applyBtn" class="blue-btn" type="submit" value="开始计算"  >
                <input id="source" name="source" type="hidden" size="30" value="m站装修计算器">
            </form>
            <div id="errorCue" class="hideError"><span id="errorMsg">您输入的姓名或电话有错误</span></div>
        </div>
    </section>
    <!-- quality E -->

    <!--2017-02-16 0263 start-->
    <!--updataimg start-->
    <section class="describe_img">
        <ul>
            <li><img src="<?php echo R;?>msite/calculator_new2/img/zhuangxiuContent.jpg"></li>
            <li><img src="<?php echo R;?>msite/calculator_new2/img/zhuangxiuFoot.jpg"></li>
            <!-- <li><img src="./msite/calculator_new2/img/describe3.jpg"></li>
            <li><img src="./msite/calculator_new2/img/describe4.jpg"></li>
            <li><img src="./msite/calculator_new2/img/describe5.jpg"></li>
            <li><img src="./msite/calculator_new2/img/describe6.jpg"></li>
            <li><img src="./msite/calculator_new2/img/describe7.jpg"></li> -->
        </ul>
    </section>
    <!--updataimg end-->
    <!--2017-02-16 0263 end-->

    <!-- infoMod S -->
    <section>
        <div class="infoMod">
            <p class="tit">温馨提示:</p>
            <p class="desc">1、该份报价为一年内所在地区半包（仅含轻工辅料）装修平均价格（不含水电、拆改），仅供参考</p>
            <p class="desc">2、如果您希望更快获得精准报价，请拨打服务热线 <a href="tel:400-6171-666" class="col_008">400-6171-666</a>加急预约，我们会尽快安排1-3家正规公司上门量房</p>
            <p class="desc">3、在优装美家平台选择装修公司可免费享受装修管家服务，为您提供专业预算、资深监理及管家顾问式装修管理</p>
        </div>
    </section>
    <!-- infoMod E -->

    <script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
    <script src="<?php echo R;?>msite/base/js/base.js"></script>
    <script src="<?php echo R;?>msite/base/js/manager_select.js"></script>
    <script src="<?php echo R;?>msite/calculator_new2/js/send_form.js"></script>
    <script src="<?php echo R;?>msite/calculator_new2/js/countUp.min.js"></script>
    <script>
    $(function() {

        $('#select-01').loadProvince();

        window.onload =  function(){
            hello();
            setInterval(function(){
                hello();
            },5000);
        }
        $("#readProtocal").click(function(){
            if(this.checked == true){
                $("#applyBtn").removeAttr("disabled");
                $("#applyBtn").css("background-color","#29d1c7");
            }else{
                $("#applyBtn").attr("disabled",true) ;
                $("#applyBtn").css("background-color","gray");
            }

        });
        
        
    })
    function hello(){
            var options = {
              useEasing: false, 
              useGrouping: true, 
              separator: '', 
              decimal: '.', 
            };
            var demo = new CountUp('count', 22352, 22399, 0, 3, options);
            if (!demo.error) {
                console.log(22);  
                demo.start();
            } else {
              console.error(demo.error);
            }
        }
    </script>
    
    <!-- 铂金分析监测代码 -->
    <script type="text/javascript">
        window._pt_lt = new Date().getTime();
        window._pt_sp_2 = [];
        _pt_sp_2.push('setAccount,47507b56');
        var _protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        (function() {
            var atag = document.createElement('script'); atag.type = 'text/javascript'; atag.async = true;
            atag.src = _protocol + 'js.ptengine.cn/47507b56.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(atag, s);
        })();
    </script>
</body>

</html>
