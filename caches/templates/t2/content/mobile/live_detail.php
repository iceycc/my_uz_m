<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>优装美家—管家式装修服务 有品质的低价</title>
    <meta name="keywords" content="装修管家,量房设计,装修施工,材料商城,环保方案,装修服务,装修图库,建材商城,装修攻略、优装网、装修网、优装美家">
    <meta name="description" content="优装美家为您提供免费专业咨询、免费量房、免费设计、免费装修保险、免费环保检测、优装网-专业装修网优选装修公司、优选建材商品、优选装修管家、优选环保服务">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="stylesheet" href="<?php echo R;?>msite/building_live_new/css/iconfont.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/base/css/base.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/building_live_new/css/building_new.css">
    <link rel="stylesheet" href="<?php echo R;?>msite/building_live_new/css/animate.css">
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?0a9b93e0ac9bdda145e2d4f6ffa88ee5";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>
<body>
<header>
    <div class="tit_minu">
        <a id="go-back" target="_self" title="优装美家">
            <i class="iconfont icon-goback"></i>
        </a>
        <a class="back_index" href="mobile-index.html">首页</a>
    </div>
    <h1 class="header-title">工地直播</h1>

    <button id="favor-btn"><i class="iconfont icon-star_one"></i></button>
</header>
<!--kongjianduibitu start-->
<section class="newspace" id="space_img">
    <script type="text/template" id="space-img-template">
        <% var spaceImgData = siteMassages.comparison_photo; %>
        <% if(spaceImgData){ %>
        <div class="new_space_cont">
            <div class="spacebox">
                <% for(var i = 0;i < spaceImgData.length;i++){ %>
                    <% var item = spaceImgData[i]; %>
                    <% if(i == 0){ %>

                    <ul class="nspace_mode clearfix"  style="display: block;" type="<%= item.title %>">
                    <% }else{ %>
                    <ul class="nspace_mode clearfix"  type="<%= item.title %>" >
                    <% } %>
                        <li class="nspaceimg fl" type="big_attach1">
                            <img src="<%= item.attach1 %>">
                            <div class="nsp_mod nsp_mod_old">
                                <i></i><span>装修前</span>
                            </div>
                        </li>
                        <li class="nspaceimg fl" type="big_attach2">
                            <img src="<%= item.attach2 %>">
                            <div class="nsp_mod nsp_mod_new">
                                <span>装修后</span><i></i>
                            </div>
                        </li>
                    </ul>
                <% } %>
            </div>

            <ol class="space_button">
                <% for(var i = 0;i < spaceImgData.length;i++){ %>
                    <% var item = spaceImgData[i]; %>
                    <% if(i == 0){ %>
                        <li class="sp_btnlist active">
                    <% }else{ %>
                        <li class="sp_btnlist">
                    <% } %>
                            <i class="iconfont icon-<%= item.title %>"></i>
                            <span><%= spaceImgName[item.title] %></span>
                        </li>
                <% } %>
            </ol>
        </div>
        <% } %>
    </script>
</section>
<!--空间照片对比图 end-->

<section id="site-title-mas">
    <script type="text/template" id="butler-info-template">
        <% var siteTitle = siteMassages.node %>
        <% var iscapa = "inline-block" %>
        <% if(siteTitle.level == 2){iscapa = "none";} %>
        <section class="butler_info">
            <div class="butler_logo">
                <a href="/mobile-m_butler_details.html?butlerid=<%= siteTitle.uid %>">
                    <img src="<%= siteTitle.personalphotos %>" alt="logo">
                    <span style="display: <%= iscapa %>;" class="logo_capa"></span>
                </a>
            </div>
            <div class="butler_text">
                <div class="butler_text_name"><b><%= siteTitle.gjname %></b><span
                        style="display: <%= iscapa %>;">金牌管家</span></div>
                <p><%= siteTitle.name %></p>
                <ul class="clearfix">
                    <% var homestyles = siteTitle.homestyle; %>

                    <% if(siteTitle.budget){ %>
                        <li><%= siteTitle.budget %></li>
                    <% } %>

                    <% if(siteTitle.area){ %>
                        <li><%= siteTitle.area %>m²</li>
                    <% } %>

                    <% if(homestyles[0]){ %>
                        <li><%= homestyles[0] %></li>
                    <% } %>

                    <% if(siteTitle.way[0]){ %>
                        <li><%= siteTitle.way[0] %></li>
                    <% } %>
                </ul>
            </div>
        </section>
        <!--zhuang xiu gongsi-->
        <section class="company">
            <ul class="company_ul">
                <% var titnewnode = siteMassages.node %>
                <% if(titnewnode.company){ %>
                <li class="company_list company_list_company">
                    <a class="clearfix" href="mobile-company_detail.html?company_id=<%= titnewnode.id %>">
                        <div class="company_icon_box fl">
                            <i class="iconfont icon-zhuangxiugongsis"></i>
                        </div>
                        <div class="company_name fl">
                            <p class="company_name1"><%= titnewnode.company %></p>
                            <p class="company_name2">(装修公司)</p>
                        </div>
                        <i class="iconfont icon-goback"></i>
                    </a>

                </li>
                <% } %>
            </ul>
        </section>
    </script>
</section>
<!--装修节点 s-->
<section class="zxnode_topcolorbg"></section>

<section class="zxnode">
    <ul class="zxnode_start  clearfix">
        <li class="zxnode_start_name">装修前</li>
        <!-- 上门量房 s-->
        <li isload="0" ismassage="0" id="node1" class="isnodemassage zxnode_list fr">

            <div class="zxnode_logo">
                <i class="iconfont icon-liangfang zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>

            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">上门量房</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode1">
                <script type="text/template" id="snode1-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 11 ){ %>
                    <div class="amount_room" style="padding-bottom: 1rem;">

                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <% if(item.companyname){ %>
                        <ul class="amount_firm">

                            <% var companys = item.companyname %>
                            <% for(var j = 0;j
                            <companys.length
                                    ;j++){ %>
                                <% if(companys[j].col8 == "是"){ %>
                                <% companys[j].col8 = "已量房"; %>
                                <% }else if(companys[j].col8 == "否"){ %>
                                <% companys[j].col8 = "未量房"; %>
                                <% } %>
                                <li>
                                    <p><%= companys[j].col2 %></p>
                                    <span class="color_blue"><%= companys[j].col8 %></span>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                       <!-- <% if(item.check_detail.length > 0){ %>
                        <table class="meter_table" >
                            <tr>
                                <th>量房现场信息</th>
                                <th>结果</th>
                            </tr>

                            <% var checkDetail = item.check_detail %>
                            <% for(var u = 0;u
                            <checkDetail.length
                                    ;u++){ %>
                                <tr>
                                    <td><%= checkDetail[u].title %></td>
                                    <td><%= checkDetail[u].qua %></td>
                                </tr>
                                <% } %>
                        </table>
                        <% } %>-->

                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!-- 上门量房 e-->

        <!--报价审核 s-->
        <li isload="0" ismassage="0" id="node2" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">报价审核</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-dingdanshenhes zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode2">
                <script type="text/template" id="snode2-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 12 ){ %>


                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix" >
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                            ;p++){ %>
                            <% if(photos.length<1){break;} %>
                            <li class="pre_list fl">
                                <div class="pre_list_imgbox">
                                    <img src="<%= photos[p] %>" alt="">
                                </div>
                            </li>
                            <% } %>

                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>

                        <% if(item.company_photo.length >0){ %>
                        <p class="review_tit"><%= item.company_name %></p>
                        <ul class="company_audit clearfix" style="margin-top: -1rem;">
                            <% for(var j = 0;j
                            <item.company_photo.length
                            ;j++){ %>

                            <% var conpanyItem = item.company_photo[j]; %>
                                <li class="company_photo_parent clearfix company_img_ul">
                                    <p class="fontsize07 color_999  company_audit_p"><%= j+1 %>. <%=
                                        conpanyItem.company_name %></p>
                                    <ol class="clearfix company_img_ul">
                                        <% if(conpanyItem.quote){ %>
                                        <% if(conpanyItem.quote.length > 1){ %>

                                        <li class="fl company_img_list company_img_first company_pnoto_table"
                                            iscont="0">
                                            <div class="company_imgbox company_imgbox_down">
                                                <div class="company_imgboxcont">
                                                    <img src="<%= conpanyItem.quote[1] %>" alt="">
                                                </div>
                                            </div>
                                            <div class="company_imgbox company_imgbox_up">
                                                <div class="company_imgboxcont">
                                                    <img src="<%= conpanyItem.quote[0] %>" alt="">
                                                </div>
                                            </div>
                                            <p class="fontsize07 textcenter color_999 company_audit_p">报价详情</p>
                                        </li>
                                        <% }else{ %>
                                        <li class="fl company_img_list company_img_first company_pnoto_table"
                                            iscont="0">
                                            <div class="company_imgbox">
                                                <div class="company_imgboxcont">
                                                    <img src="<%= conpanyItem.quote[0] %>" alt="">
                                                </div>
                                            </div>
                                            <p class="fontsize07 textcenter color_999 company_audit_p">报价详情</p>
                                        </li>

                                        <% } %>
                                        <% } %>

                                        <% if(conpanyItem.design_photo){ %>
                                        <% if(conpanyItem.design_photo.length > 1){ %>
                                        <li class="fl company_img_list  company_pnoto_table" iscont="1">

                                            <div class="company_imgbox company_imgbox_down">
                                                <div class="company_imgboxcont">
                                                    <img src="<%= conpanyItem.design_photo[1] %>" alt="">
                                                </div>
                                            </div>
                                            <div class="company_imgbox company_imgbox_up">
                                                <div class="company_imgboxcont">
                                                    <img src="<%= conpanyItem.design_photo[0] %>" alt="">
                                                </div>
                                            </div>

                                            <p class="fontsize07 color_999 textcenter company_audit_p">图纸</p>
                                        </li>
                                        <% }else{ %>
                                        <li class="fl company_img_list  company_pnoto_table" iscont="1">
                                            <div class="company_imgbox company_imgbox_up">
                                                <div class="company_imgboxcont">
                                                    <img src="<%= conpanyItem.design_photo[0] %>" alt="">
                                                </div>
                                            </div>

                                            <p class="fontsize07 color_999 textcenter company_audit_p">图纸</p>
                                        </li>
                                        <% } %>
                                        <% } %>
                                    </ol>


                                </li>
                            <% } %>

                            <!--second-->

                        </ul>
                        <% } %>
                        <!--审核报告-->
                        <!--zongjie-->
                        <div class="company_audit_list company_audit_shenhe">

                            <% if(item.bj_photo){ %>
                            <% if(item.bj_photo.length > 1){ %>
                            <p class="fontsize07 color_999  company_audit_p"><%= item.company_names %>.</p>
                            <ol class="clearfix company_img_ul audit_report ">
                                <li class="fl company_img_list company_img_first " uid="<%= item.uid %>">
                                    <div class="company_imgbox company_imgbox_down">
                                        <div class="company_imgboxcont">
                                            <img src="<%= item.bj_photo[1] %>" alt="">
                                        </div>
                                    </div>
                                    <div class="company_imgbox company_imgbox_up">
                                        <div class="company_imgboxcont">
                                            <img src="<%= item.bj_photo[0] %>" alt="">
                                        </div>
                                    </div>
                                    <p class="fontsize07 textcenter color_999 company_audit_p">审核报告</p>
                                </li>
                            </ol>
                            <% }else{ %>

                            <ol class="clearfix company_img_ul audit_report ">
                                <li class="fl company_img_list company_img_first " uid="<%= item.uid %>">
                                    <div class="company_imgbox">
                                        <div class="company_imgboxcont">
                                            <img src="<%= item.bj_photo[0] %>" alt="">
                                        </div>
                                    </div>
                                    <p class="fontsize07 textcenter color_999 company_audit_p">审核报告</p>
                                </li>
                            </ol>
                            <% } %>
                            <% } %>
                        </div>

                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--报价审核 e-->

        <!--签订意向定金 s-->
        <li isload="0" ismassage="0" id="node3" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">签订意向定金</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-yixiangdingjins zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode3">
                <script type="text/template" id="snode3-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 15 ){ %>

                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <% if(item.company){ %>
                        <p class="review_tit">选定装修公司：<%= item.company.col2 %></p>
                        <% } %>

                        <% if(item.nodename){ %>
                        <p class="review_tit" style="margin-top: .5rem;"><%= item.nodename.nodename %></p>
                        <% } %>
                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--签订意向定金 e-->

        <!--预交底 s-->
        <li isload="0" ismassage="0" id="node4" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeopen">
                <span class="zxnodestatus fl">预交底</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-yujiaodiss zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode4">
                <script type="text/template" id="snode4-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 17 ){ %>
                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <p class="pre_cen_tit fontsize07 lineheight2" style="margin-bottom: .4rem;">现场参与人员：<%= item.col8 %></p>
                        <!--预交底现场-->
                        <% if(item.check_detail.length > 0){ %>
                        <table class="meter_table">
                            <tr>
                                <th>预交底现场信息</th>
                                <th>结果</th>
                            </tr>

                            <% var checkDetail = item.check_detail %>
                            <% for(var u = 0;u
                            <checkDetail.length
                                    ;u++){ %>
                                <tr>
                                    <td><%= checkDetail[u].title %></td>
                                    <%if(checkDetail[u].qua == '合格'){  %>
                                    <td>是</td>
                                    <% }else{ %>
                                    <td>否</td>
                                    <% } %>
                                </tr>
                                <% } %>
                        </table>
                        <% } %>
                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--预交底 e-->

        <!--签订三方合同 s-->
        <li isload="0" ismassage="0" id="node5" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">签订三方合同</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-qiandingsanfanghetongs zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode5">
                <script type="text/template" id="snode5-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 19 ){ %>
                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <% if(item.company){ %>
                        <p class="review_tit">签订公司：<%= item.company.col2 %></p>
                        <% } %>
                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--签订三方合同 e-->
    </ul>
    <ul class="zxnode_start zxnode_march clearfix">
        <li class="zxnode_start_name">装修中</li>
        <!--开工仪式 s-->
        <li isload="0" ismassage="0" id="node6" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">开工仪式</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-kaigongyishis zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode6">
                <script type="text/template" id="snode6-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 21 ){ %>
                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <p class="pre_cen_tit fontsize07">现场参与人员：<%= item.col8 %></p>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--开工仪式 e-->

        <!--水电材料验收 s-->
        <li isload="0" ismassage="0" id="node7" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">水电材料验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-shuidianyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode7">
                <script type="text/template" id="snode7-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>


                    <% if(item.nodeid == 25 ){ %>
                    <% var batteryGc = item.check_detail %>
                    <% if(item.photo.length > 0 || item.content || item.addtime){ %>
                    <div class="review review fontsize07 color_organe">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>

                        <% if(item.addtime){ %>
                        <p class="pre_cen_tit fontsize07 color_blue">验收时间：<%= item.addtime %></p>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>

                    </div>
                    <% } %>
                    <!--水路-->
                    <div class="water border_bot_none">
                        <!---->
                        <ul class="water_ul">
                            <% if(item.check_detail.qualified || item.count != 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sum %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_detail.qualified){ %>
                                    <ul>
                                        <% var waterContindex = 0; %>
                                        <% for(var t = 0;t
                                        <batteryGc.qualified.length
                                                ;t++){ %>
                                            <% var wateritemb = batteryGc.qualified[t]; %>
                                            <% if(wateritemb.img_yse.length == 1 ){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %>(<%= wateritemb.detailO  %>)</h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritemb.img_yse.length > 1){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %>(<%= wateritemb.detailO  %>)</h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.count > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.count %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>

                                </div>
                            </li>
                            <% } %>
                            <% if(item.check_detail.unqualified){ %>
                            <!--整改项-->
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= batteryGc.unqualified.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <batteryGc.unqualified.length
                                            ;j++){ %>
                                        <% var waterzgb = batteryGc.unqualified[j]; %>
                                        <div class="water_zg_par">
                                            <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzgb.qua%>：<%=waterzgb.title %>(<%= waterzgb.detailO  %>)</h3>

                                            <% if(waterzgb.tomark){ %>
                                            <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzgb.tomark %></h3>
                                            <% } %>
                                            <ul class="clearfix water_list_zgul">
                                                <li class="water_list_zgli fl">
                                                    <div class="water_list_zgli_child">
                                                        <div class="company_imgbox">
                                                            <div class="company_imgboxcont">
                                                                <img src="<%= waterzgb.img_yse[0] %>" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                                </li>
                                                <li class="water_list_zgli fl">

                                                    <!--两种状态-->
                                                    <% if(waterzgb.chan_Srcs == 1){ %>
                                                    <!--整改中-->
                                                    <div class="company_imgbox water_list_zgway">
                                                        <div class="company_imgboxcont">
                                                            <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                                 alt="">
                                                        </div>
                                                        <p class="water_list_zgwaytext">整改中</p>
                                                    </div>
                                                    <% }else{ %>
                                                    <!--整改后-->
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzgb.chan_Srcs[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                    <% } %>
                                                </li>
                                            </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>

                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--水电材料验收 e-->

        <!--水电工程验收 s-->
        <li isload="0" ismassage="0" id="node8" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">水电工程验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-shuidiangcyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode8">
                <script type="text/template" id="snode8-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 27 ){ %>
                    <% var wraterGc = item.check_waterdetail; %>
                    <% var batteryGc = item.check_detail; %>
                    <% if(item.photo.length > 0 || item.content || item.addtime){ %>
                    <div class="review fontsize07 color_organe">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <% if(item.addtime){ %>
                        <p class="pre_cen_tit fontsize07 color_blue">验收时间：<%= item.addtime %></p>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>


                    </div>
                    <% } %>
                    <!--水路-->
                    <% if(item.check_waterdetail.qualifieds || item.counts != 0 || item.check_waterdetail.unqualifieds){ %>
                    <div class="water">
                        <!---->
                        <h3 class="water_title">一、水路</h3>
                        <ul class="water_ul">
                            <% if(item.check_waterdetail.qualifieds || item.counts != 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sums %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_waterdetail.qualifieds){ %>
                                    <ul>
                                        <% var waterContindexs = 0; %>
                                        <% for(var j = 0;j
                                        <wraterGc.qualifieds.length
                                                ;j++){ %>
                                            <% var wateritem = wraterGc.qualifieds[j]; %>
                                            <% if(wateritem.img_yse.length == 1 ){ %>
                                            <% waterContindexs++; %>
                                            <li>
                                                <h3 class="h3"><%= waterContindexs %>：<%= wateritem.title %></h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritem.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritem.img_yse.length > 1){ %>
                                            <% waterContindexs++; %>
                                            <li>
                                                <h3 class="h3"><%= waterContindexs %>：<%= wateritem.title %></h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritem.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritem.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.counts > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>&stem=water"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.counts %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>

                                </div>
                            </li>
                            <% } %>
                            <!--整改项-->
                            <% if(item.check_waterdetail.unqualifieds){ %>
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= wraterGc.unqualifieds.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <wraterGc.unqualifieds.length
                                            ;j++){ %>
                                        <% var waterzg = wraterGc.unqualifieds[j]; %>
                                        <div class="water_zg_par">
                                            <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzg.qua%>：<%= waterzg.title %></h3>
                                            <% if(waterzg.tomark){ %>
                                            <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzg.tomark %></h3>
                                            <% } %>
                                            <ul class="clearfix water_list_zgul">
                                                <li class="water_list_zgli fl">
                                                    <div class="water_list_zgli_child">
                                                        <div class="company_imgbox">
                                                            <div class="company_imgboxcont">
                                                                <img src="<%= waterzg.img_yse[0] %>" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                                </li>
                                                <li class="water_list_zgli fl">

                                                    <!--两种状态-->
                                                    <% if(waterzg.chan_Srcs == 1){ %>
                                                    <!--整改中-->
                                                    <div class="company_imgbox water_list_zgway">
                                                        <div class="company_imgboxcont">
                                                            <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                                 alt="">
                                                        </div>
                                                        <p class="water_list_zgwaytext">整改中</p>
                                                    </div>
                                                    <% }else{ %>
                                                    <!--整改后-->
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzg.chan_Srcs[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                    <% } %>
                                                </li>
                                            </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>

                    </div>
                    <% } %>
                    <!--电路-->
                    <% if(item.check_detail.qualified || item.count != 0){ %>
                    <div class="circuit">
                        <!---->
                        <h3 class="water_title">二、电路</h3>
                        <ul class="water_ul">
                            <% if(item.check_detail.qualified || item.count != 0 || item.check_detail.unqualified){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sum %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_detail.qualified){ %>
                                    <ul>
                                        <% var waterContindex = 0; %>
                                        <% for(var t = 0;t
                                        <batteryGc.qualified.length
                                                ;t++){ %>
                                            <% var wateritemb = batteryGc.qualified[t]; %>
                                            <% if(wateritemb.img_yse.length == 1 ){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritemb.img_yse.length > 1){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.count > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.count %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>
                                </div>
                            </li>
                            <% } %>
                            <!--整改项-->
                            <% if(item.check_detail.unqualified){ %>
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= batteryGc.unqualified.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <batteryGc.unqualified.length
                                            ;j++){ %>
                                        <% var waterzgb = batteryGc.unqualified[j]; %>
                                        <div class="water_zg_par">
                                            <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzgb.qua
                                                %>：<%=
                                                waterzgb.title %></h3>

                                            <% if(waterzgb.tomark){ %>
                                            <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzgb.tomark %></h3>
                                            <% } %>
                                            <ul class="clearfix water_list_zgul">
                                                <li class="water_list_zgli fl">
                                                    <div class="water_list_zgli_child">
                                                        <div class="company_imgbox">
                                                            <div class="company_imgboxcont">
                                                                <img src="<%= waterzgb.img_yse[0] %>" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                                </li>
                                                <li class="water_list_zgli fl">

                                                    <!--两种状态-->
                                                    <% if(waterzgb.chan_Srcs == 1){ %>
                                                    <!--整改中-->
                                                    <div class="company_imgbox water_list_zgway">
                                                        <div class="company_imgboxcont">
                                                            <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                                 alt="">
                                                        </div>
                                                        <p class="water_list_zgwaytext">整改中</p>
                                                    </div>
                                                    <% }else{ %>
                                                    <!--整改后-->
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzgb.chan_Srcs[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                    <% } %>
                                                </li>
                                            </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>
                    </div>
                    <% } %>
                    <% } %>
                    <% } %>
                </script>

            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--水电工程验收 e-->

        <!--瓦木材料验收 s-->
        <li isload="0" ismassage="0" id="node9" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">瓦木材料验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-wamuyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode9">
                <script type="text/template" id="snode9-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>


                    <% if(item.nodeid == 29 ){ %>
                    <% var batteryGc = item.check_detail %>
                    <% if(item.photo.length > 0 || item.content || item.addtime){ %>
                    <div class="review fontsize07 color_organe">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <% if(item.addtime){ %>
                        <p class="pre_cen_tit fontsize07 color_blue">验收时间：<%= item.addtime %></p>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>

                    </div>
                    <% } %>
                    <!--水路-->
                    <div class="water border_bot_none">
                        <!---->
                        <ul class="water_ul">
                            <% if(item.check_detail.qualified || item.count != 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sum %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_detail.qualified){ %>
                                    <ul>
                                        <% var waterContindex = 0; %>
                                        <% for(var t = 0;t
                                        <batteryGc.qualified.length
                                                ;t++){ %>
                                            <% var wateritemb = batteryGc.qualified[t]; %>
                                            <% if(wateritemb.img_yse.length == 1 ){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %>(<%= wateritemb.detailO  %>)</h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritemb.img_yse.length > 1){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %>(<%= wateritemb.detailO  %>)</h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.count > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.count %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>
                                </div>
                            </li>
                            <% } %>
                            <!--整改项-->
                            <% if(item.check_detail.unqualified){ %>
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= batteryGc.unqualified.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <batteryGc.unqualified.length
                                            ;j++){ %>
                                        <% var waterzgb = batteryGc.unqualified[j]; %>
                                        <div class="water_zg_par">
                                            <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzgb.qua
                                                %>：<%=
                                                waterzgb.title %>(<%= waterzgb.detailO  %>)</h3>
                                            <% if(waterzgb.tomark){ %>
                                            <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzgb.tomark %></h3>
                                            <% } %>
                                            <ul class="clearfix water_list_zgul">
                                                <li class="water_list_zgli fl">
                                                    <div class="water_list_zgli_child">
                                                        <div class="company_imgbox">
                                                            <div class="company_imgboxcont">
                                                                <img src="<%= waterzgb.img_yse[0] %>" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                                </li>
                                                <li class="water_list_zgli fl">

                                                    <!--两种状态-->
                                                    <% if(waterzgb.chan_Srcs == 1){ %>
                                                    <!--整改中-->
                                                    <div class="company_imgbox water_list_zgway">
                                                        <div class="company_imgboxcont">
                                                            <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                                 alt="">
                                                        </div>
                                                        <p class="water_list_zgwaytext">整改中</p>
                                                    </div>
                                                    <% }else{ %>
                                                    <!--整改后-->
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzgb.chan_Srcs[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                    <% } %>
                                                </li>
                                            </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>

                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--瓦木材料验收 e-->

        <!--防水工程 s-->
        <li isload="0" ismassage="0" id="node10" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">防水工程验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-fangshuigcyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode10">
                <script type="text/template" id="snode10-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 28 ){ %>
                    <% if(item.photo.length > 0 || item.content || item.addtime){ %>
                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <% if(item.addtime){ %>
                        <p class="pre_cen_tit fontsize07 color_blue">验收时间：<%= item.addtime %></p>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                    </div>
                    <% } %>
                    <% if(item.check_detail){ %>
                    <p class="fontsize07 color_999  company_audit_p">验收时间：<%= item.addtime %></p>
                    <% if(item.check_detail.closed_water[0].qua == "是"){ %>
                    <div class="auditing_stades" idYes="0">
                        <div class="water_minubox ">
                            <div class=" water_list_tit color_blue">
                                <i class="iconfont icon-right fr" style="top: .5rem;"></i><span class="fl">防水合格</span>
                            </div>
                        </div>
                    </div>
                    <% }else{ %>
                    <div class="auditing_stades" idYes="1">
                        <div class="water_minubox clearfix">
                            <div class="water_list_tit color_organe">
                                <i class="iconfont icon-tanhaos color_organe fr"></i><span
                                    class="fl color_organe">防水未合格</span>
                            </div>
                        </div>
                    </div>
                    <% } %>
                    <div class="company_audit_list">

                        <% if(item.check_detail.closed_water[0].qua == "是"){ %>
                        <% if(item.check_detail.closed_water[0].img_yse.length > 0){ %>
                        <ol class="clearfix company_img_ul audit_report ">

                            <% if(item.check_detail.closed_water[0].img_yse.length == 1){ %>
                                <li class="fl company_img_list company_img_first ">
                                    <div class="company_imgbox company_imgbox_up" style="top: 0;">
                                        <div class="company_imgboxcont">
                                            <img src="<%= item.check_detail.closed_water[0].img_yse[0] %>" alt="">
                                        </div>
                                    </div>
                                    <p class="fontsize07 textcenter color_999 company_audit_p">闭水试验</p>
                                </li>
                            <% }else{ %>
                                <li class="fl company_img_list company_img_first ">
                                    <div class="company_imgbox company_imgbox_down">
                                        <div class="company_imgboxcont">
                                            <img src="<%= item.check_detail.closed_water[0].img_yse[1] %>" alt="">
                                        </div>
                                    </div>
                                    <div class="company_imgbox company_imgbox_up" style="top: 0;">
                                        <div class="company_imgboxcont">
                                            <img src="<%= item.check_detail.closed_water[0].img_yse[0] %>" alt="">
                                        </div>
                                    </div>
                                    <p class="fontsize07 textcenter color_999 company_audit_p">闭水试验</p>
                                </li>

                            <% } %>
                        </ol>
                        <% } %>
                        <% }else{ %>

                        <% if(item.check_detail.closed_water[0].chan_Srcs.length > 0){ %>
                        <ol class="clearfix company_img_ul audit_report ">
                            <% if(item.check_detail.closed_water[0].chan_Srcs.length == 1){ %>
                            <li class="fl company_img_list company_img_first ">
                                <div class="company_imgbox company_imgbox_up" style="top: 0;">
                                    <div class="company_imgboxcont">
                                        <img src="<%= item.check_detail.closed_water[0].img_yse[0] %>" alt="">
                                    </div>
                                </div>
                                <p class="fontsize07 textcenter color_999 company_audit_p">闭水试验</p>
                            </li>
                            <% }else{ %>
                            <li class="fl company_img_list company_img_first ">
                                <div class="company_imgbox company_imgbox_down">
                                    <div class="company_imgboxcont">
                                        <img src="<%= item.check_detail.closed_water[0].img_yse[1] %>" alt="">
                                    </div>
                                </div>
                                <div class="company_imgbox company_imgbox_up" style="top: 0;">
                                    <div class="company_imgboxcont">
                                        <img src="<%= item.check_detail.closed_water[0].img_yse[0] %>" alt="">
                                    </div>
                                </div>
                                <p class="fontsize07 textcenter color_999 company_audit_p">闭水试验</p>
                            </li>

                            <% } %>
                        </ol>
                        <% } %>
                        <% } %>
                    </div>
                    <% }else{ %>
                    <div style="height: 1rem;"></div>
                    <% } %>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--防水工程 e-->

        <!--瓦木工程 s-->
        <li isload="0" ismassage="0" id="node11" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">瓦木工程验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-wamugongchengyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode11">
                <script type="text/template" id="snode11-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 31 ){ %>
                    <% var batteryGc = item.check_detail %>
                    <% if(item.photo.length > 0 || item.content || item.addtime){ %>
                        <div class="review fontsize07 color_organe">

                            <% if(item.photo.length>0){ %>
                            <ul class="pre_img clearfix">
                                <% var photos = item.photo; %>
                                <% for(var p = 0;p
                                <photos.length
                                        ;p++){ %>
                                    <% if(photos.length<1){break;} %>
                                    <li class="pre_list fl">
                                        <div class="pre_list_imgbox">
                                            <img src="<%= photos[p] %>" alt="">
                                        </div>
                                    </li>
                                    <% } %>
                            </ul>
                            <% } %>
                            <% if(item.addtime){ %>
                            <p class="pre_cen_tit fontsize07 color_blue">验收时间：<%= item.addtime %></p>
                            <% } %>
                            <!--管家说-->
                            <% if(item.content){ %>
                            <ul class="butler_say">
                                <li class="clearfix butler_say_list">
                                    <div class="fl say_logo">
                                        <img src="<%= item.gjphoto %>">
                                    </div>
                                    <div class="clearfix fl say_text">

                                        <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                    </div>
                                </li>
                            </ul>
                            <% } %>


                        </div>
                    <% } %>
                    <!--水路-->
                    <div class="water border_bot_none">
                        <!---->
                        <ul class="water_ul">
                            <% if(item.check_detail.qualified || item.count != 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sum %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_detail.qualified){ %>
                                    <ul>
                                        <% var waterContindex = 0; %>
                                        <% for(var t = 0;t
                                        <batteryGc.qualified.length
                                                ;t++){ %>
                                            <% var wateritemb = batteryGc.qualified[t]; %>
                                            <% if(wateritemb.img_yse.length == 1 ){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritemb.img_yse.length > 1){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.count > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.count %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>
                                </div>
                            </li>
                            <% } %>
                            <% if(item.check_detail.unqualified){ %>

                            <!--整改项-->
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= batteryGc.unqualified.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <batteryGc.unqualified.length
                                            ;j++){ %>
                                        <% var waterzgb = batteryGc.unqualified[j]; %>
                                        <div class="water_zg_par">
                                            <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzgb.qua
                                                %>：<%=
                                                waterzgb.title %></h3>
                                            <% if(waterzgb.tomark){ %>
                                            <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzgb.tomark %></h3>
                                            <% } %>
                                            <ul class="clearfix water_list_zgul">
                                                <li class="water_list_zgli fl">
                                                    <div class="water_list_zgli_child">
                                                        <div class="company_imgbox">
                                                            <div class="company_imgboxcont">
                                                                <img src="<%= waterzgb.img_yse[0] %>" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                                </li>
                                                <li class="water_list_zgli fl">

                                                    <!--两种状态-->
                                                    <% if(waterzgb.chan_Srcs == 1){ %>
                                                    <!--整改中-->
                                                    <div class="company_imgbox water_list_zgway">
                                                        <div class="company_imgboxcont">
                                                            <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                                 alt="">
                                                        </div>
                                                        <p class="water_list_zgwaytext">整改中</p>
                                                    </div>
                                                    <% }else{ %>
                                                    <!--整改后-->
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzgb.chan_Srcs[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                    <% } %>
                                                </li>
                                            </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>

                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--瓦木工程 e-->

        <!--油漆材料 s-->
        <li isload="0" ismassage="0" id="node12" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">油漆材料验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-youqicailiaoyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode12">
                <script type="text/template" id="snode12-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 33 ){ %>
                    <% var batteryGc = item.check_detail %>
                    <% if(item.photo.length > 0 || item.content || item.addtime){ %>
                    <div class="review fontsize07 color_organe">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <% if(item.addtime){ %>
                        <p class="pre_cen_tit fontsize07 color_blue">验收时间：<%= item.addtime %></p>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>

                    </div>
                    <% } %>
                    <!--水路-->
                    <div class="water border_bot_none">
                        <!---->
                        <ul class="water_ul">
                            <% if(item.check_detail.qualified || item.count > 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sum %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_detail.qualified){ %>
                                    <ul>

                                        <% var waterContindex = 0; %>
                                        <% for(var t = 0;t
                                        <batteryGc.qualified.length
                                                ;t++){ %>
                                            <% var wateritemb = batteryGc.qualified[t]; %>
                                            <% if(wateritemb.img_yse.length == 1 ){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %>(<%= wateritemb.detailO  %>)</h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritemb.img_yse.length > 1){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %>(<%= wateritemb.detailO  %>)</h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.count > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.count %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>
                                </div>
                            </li>
                            <% } %>
                            <!--整改项-->
                            <% if(item.check_detail.unqualified){ %>
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= batteryGc.unqualified.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <batteryGc.unqualified.length
                                            ;j++){ %>
                                        <% var waterzgb = batteryGc.unqualified[j]; %>
                                        <div class="water_zg_par">
                                            <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzgb.qua
                                                %>：<%=
                                                waterzgb.title %>(<%= waterzgb.detailO  %>)</h3>
                                            <% if(waterzgb.tomark){ %>
                                            <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzgb.tomark %></h3>
                                            <% } %>
                                            <ul class="clearfix water_list_zgul">
                                                <li class="water_list_zgli fl">
                                                    <div class="water_list_zgli_child">
                                                        <div class="company_imgbox">
                                                            <div class="company_imgboxcont">
                                                                <img src="<%= waterzgb.img_yse[0] %>" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                                </li>
                                                <li class="water_list_zgli fl">

                                                    <!--两种状态-->
                                                    <% if(waterzgb.chan_Srcs == 1){ %>
                                                    <!--整改中-->
                                                    <div class="company_imgbox water_list_zgway">
                                                        <div class="company_imgboxcont">
                                                            <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                                 alt="">
                                                        </div>
                                                        <p class="water_list_zgwaytext">整改中</p>
                                                    </div>
                                                    <% }else{ %>
                                                    <!--整改后-->
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzgb.chan_Srcs[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                    <% } %>
                                                </li>
                                            </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>

                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--油漆材料 e-->

        <!--油漆工程 s-->
        <li isload="0" ismassage="0" id="node13" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">油漆工程验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-youqiyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode13">
                <script type="text/template" id="snode13-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 35 ){ %>
                    <% var batteryGc = item.check_detail %>
                    <% if(item.photo.length > 0 || item.content || item.addtime){ %>
                    <div class="review fontsize07 color_organe">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <% if(item.addtime){ %>
                        <p class="pre_cen_tit fontsize07 color_blue">验收时间：<%= item.addtime %></p>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>

                    </div>
                    <% } %>
                    <!--水路-->
                    <div class="water border_bot_none">
                        <!---->
                        <ul class="water_ul">
                            <% if(item.check_detail.qualified || item.count > 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sum %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_detail.qualified){ %>
                                    <ul>
                                        <% var waterContindex = 0; %>
                                        <% for(var t = 0;t
                                        <batteryGc.qualified.length
                                                ;t++){ %>
                                            <% var wateritemb = batteryGc.qualified[t]; %>
                                            <% if(wateritemb.img_yse.length == 1 ){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritemb.img_yse.length > 1){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.count > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.count %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>
                                </div>
                            </li>
                            <% } %>
                            <!--整改项-->
                            <% if(item.check_detail.unqualified){ %>
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= batteryGc.unqualified.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <batteryGc.unqualified.length
                                            ;j++){ %>
                                        <% var waterzgb = batteryGc.unqualified[j]; %>
                                        <div class="water_zg_par">
                                            <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzgb.qua
                                                %>：<%=
                                                waterzgb.title %></h3>
                                            <% if(waterzgb.tomark){ %>
                                            <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzgb.tomark %></h3>
                                            <% } %>
                                            <ul class="clearfix water_list_zgul">
                                                <li class="water_list_zgli fl">
                                                    <div class="water_list_zgli_child">
                                                        <div class="company_imgbox">
                                                            <div class="company_imgboxcont">
                                                                <img src="<%= waterzgb.img_yse[0] %>" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                                </li>
                                                <li class="water_list_zgli fl">

                                                    <!--两种状态-->
                                                    <% if(waterzgb.chan_Srcs == 1){ %>
                                                    <!--整改中-->
                                                    <div class="company_imgbox water_list_zgway">
                                                        <div class="company_imgboxcont">
                                                            <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                                 alt="">
                                                        </div>
                                                        <p class="water_list_zgwaytext">整改中</p>
                                                    </div>
                                                    <% }else{ %>
                                                    <!--整改后-->
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzgb.chan_Srcs[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                    <% } %>
                                                </li>
                                            </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>

                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--油漆工程 e-->

        <!--安装工程 s-->
        <li isload="0" ismassage="0" id="node14" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">安装工程</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-anzhuangyanshous zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode14">
                <script type="text/template" id="snode14-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 36 ){ %>
                    <% var batteryGc = item.check_detail %>
                    <% if(item.photo.length>0 || item.content){ %>
                    <div class="review fontsize07 color_organe">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                    </div>
                    <% } %>
                    <!--水路-->
                    <div class="water border_bot_none">
                        <!---->
                        <ul class="water_ul">
                            <% if(item.check_detail.qualified || item.count > 0){ %>
                            <li class="water_list">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>验收合格</span>
                                    </div>
                                    <div class="fr water_minu "><%= item.sum %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">
                                    <% if(item.check_detail.qualified){ %>
                                    <ul>
                                        <% var waterContindex = 0; %>
                                        <% for(var t = 0;t
                                        <batteryGc.qualified.length
                                                ;t++){ %>
                                            <% var wateritemb = batteryGc.qualified[t]; %>
                                            <% if(wateritemb.img_yse.length == 1 ){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_imgbox water_contimg ">
                                                    <div class="company_imgboxcont">
                                                        <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                    </div>
                                                </div>
                                            </li>
                                            <% }else if(wateritemb.img_yse.length > 1){ %>
                                            <li>
                                                <% waterContindex++; %>
                                                <h3 class="h3"><%= waterContindex %>：<%= wateritemb.title %></h3>
                                                <div class="company_img_list water_contimg">
                                                    <div class="company_imgbox company_imgbox_down">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[1] %>"
                                                                 alt="">
                                                        </div>
                                                    </div>
                                                    <div class="company_imgbox company_imgbox_up">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= wateritemb.img_yse[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <% } %>
                                            <% } %>


                                    </ul>
                                    <% } %>
                                    <% if(item.count > 0){ %>
                                    <a href="mobile-check_detail.html?nodeid=<%= item.nodeid %>&orderid=<%= siteNodeMas.URLordadeId %>"
                                       class="water_cont_link fontsize07 color_blue">其它<%= item.count %>项验收明细</a>
                                    <% }else{ %>
                                    <div style="height: 2rem;"></div>
                                    <% } %>
                                </div>
                            </li>
                            <% } %>
                            <!--整改项-->
                            <% if(item.check_detail.unqualified){ %>
                            <li class="water_list water_list_zg">
                                <!--合格项-->
                                <div class="water_minubox clearfix">
                                    <div class="fl water_list_tit color_organe"><i
                                            class="iconfont icon-tanhaos color_organe"></i><span>整改项</span></div>
                                    <div class="fr water_minu "><%= batteryGc.unqualified.length %>项目<i
                                            class="iconfont icon-slidearrow"></i></div>
                                </div>
                                <div class="water_cont">

                                    <% for(var j = 0;j
                                    <batteryGc.unqualified.length
                                            ;j++){ %>
                                        <% var waterzgb = batteryGc.unqualified[j]; %>
                                        <div class="water_zg_par">
                                            <h3 class="fontsize07 color_999 water_list_zgtit"><%= j+1 %>：<%= waterzgb.qua
                                                %>：<%=
                                                waterzgb.title %></h3>
                                            <% if(waterzgb.tomark){ %>
                                            <h3 class="fontsize07 color_999 water_list_zgtit water_listzg_tomark"><%= waterzgb.tomark %></h3>
                                            <% } %>
                                            <ul class="clearfix water_list_zgul">
                                                <li class="water_list_zgli fl">
                                                    <div class="water_list_zgli_child">
                                                        <div class="company_imgbox">
                                                            <div class="company_imgboxcont">
                                                                <img src="<%= waterzgb.img_yse[0] %>" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改前</p>
                                                </li>
                                                <li class="water_list_zgli fl">

                                                    <!--两种状态-->
                                                    <% if(waterzgb.chan_Srcs == 1){ %>
                                                    <!--整改中-->
                                                    <div class="company_imgbox water_list_zgway">
                                                        <div class="company_imgboxcont">
                                                            <img src="<?php echo R;?>msite/building_live_new/img/zhenggaizhong.jpg"
                                                                 alt="">
                                                        </div>
                                                        <p class="water_list_zgwaytext">整改中</p>
                                                    </div>
                                                    <% }else{ %>
                                                    <!--整改后-->
                                                    <div class="company_imgbox">
                                                        <div class="company_imgboxcont">
                                                            <img src="<%= waterzgb.chan_Srcs[0] %>" alt="">
                                                        </div>
                                                    </div>
                                                    <p class="fontsize07 color_organe textcenter lineheight2">整改后</p>
                                                    <% } %>
                                                </li>
                                            </ul>
                                        </div>
                                        <% } %>
                                </div>
                            </li>
                            <% } %>
                        </ul>

                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--安装工程 e-->

        <!--竣工验收 s-->
        <li isload="0" ismassage="0" id="node15" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">竣工验收</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-jungongs zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode15">
                <script type="text/template" id="snode15-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 37 ){ %>
                    <div class="review fontsize07 color_organe workend">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <!--预交底现场-->
                        <% if(item.check_detail.length > 0){ %>
                        <table class="meter_table">
                            <tr>
                                <th>验收明细</th>
                                <th>结果</th>
                            </tr>

                            <% var checkDetail = item.check_detail %>
                            <% for(var u = 0;u
                            <checkDetail.length
                                    ;u++){ %>
                                <tr>
                                    <td><%= checkDetail[u].title %></td>
                                    <td><%= checkDetail[u].qua %></td>
                                </tr>
                                <% } %>
                        </table>
                        <% } %>
                    </div>
                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--竣工验收 e-->
    </ul>
    <!--装修后-->
    <ul class="zxnode_start zxnode_march zxnode_end clearfix">
        <li class="zxnode_start_name">装修后</li>
        <!--第一次环保检测 s-->
        <li isload="0" ismassage="0" id="node16" class="isnodemassage zxnode_list  fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">第一次环保检测</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-huanbaojiances zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode16">
                <script type="text/template" id="snode16-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 39 ){ %>


                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <% if(item.addtime){ %>
                        <div class="testing_time">检测时间：<%= item.addtime %></div>
                        <% } %>

                        <% if(item.col8){ %>
                        <div class="testing_person">参检人员：<%= item.col8 %></div>
                        <% } %>

                        <% if(item.col7){ %>
                            <% if(item.col7 == "是"){ %>
                                <div class="testing_person">检测结果：合格</div>
                            <% }else{ %>
                                <div class="testing_person">检测结果：不合格</div>
                            <% } %>

                        <% } %>
                    </div>


                    <div class="auditing_stades">
                        <% if(item.col7 == '是'){ %>
                            <div class="water_minubox clearfix">
                                <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>通过</span>
                                </div>
                            </div>
                        <% }else{ %>
                            <div class="water_minubox clearfix">
                                <div class="fl water_list_tit color_organe"><i
                                        class="iconfont icon-tanhaos color_organe"></i><span class="color_organe">未通过</span>
                                </div>
                            </div>
                            <% if(item.remark){ %>
                            <h3 class="fontsize07 color_999 water_list_zgtit">不合格原因：<%= item.remark %></h3>
                            <% } %>

                        <% } %>
                        <div class="water_cont">
                            <% if(item.check_detail.qualified){ %>
                            <ul>
                                <% for(var t = 0;t<item.check_detail.qualified.length;t++){%>
                                <% var items = item.check_detail.qualified[t] %>
                                <li>
                                    <h3 class="h3"><%= t+1 %>：<%= items.title %></h3>
                                    <% if(items.img_yse.length > 1 ){ %>
                                    <div class="company_img_list water_contimg">
                                        <div class="company_imgbox company_imgbox_down">
                                            <div class="company_imgboxcont">
                                                <img src="<%= items.img_yse[1] %>" alt="">
                                            </div>
                                        </div>
                                        <div class="company_imgbox company_imgbox_up">
                                            <div class="company_imgboxcont">
                                                <img src="<%= items.img_yse[0] %>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <% }else{ %>
                                    <div class="company_img_list water_contimg">
                                        <div class="company_imgbox">
                                            <div class="company_imgboxcont">
                                                <img src="<%= items.img_yse[0] %>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <% } %>
                                </li>
                                <% } %>
                            </ul>

                            <% } %>
                        </div>

                    </div>
                    <% } %>
                    <% } %>

                </script>

            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--第一次环保检测 e-->

        <!--维保 s-->
        <li isload="0" ismassage="0" id="node17" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">维保</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-weibaoss zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode17">
                <script type="text/template" id="snode17-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>

                    <% if(item.nodeid == 45 ){ %>
                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>

                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <!--<div class="testing_time">维保时间:&nbsp;<%= item.addtime %></div>
                        <div class="testing_person">参与维保人员:&nbsp;<%= item.col8 %></div>
                        <div class="testing_person">可以返还装修公司维保款:&nbsp;<%= item.col7 %></div>-->
                        <div class="testing_time">
                                维保时间 截止至 <%= item.addtime %>
                        </div>
                        <% if(item.ret){ %>
                        <div class="testing_person" style="margin-top: 1rem;text-indent: 2em;"><%= item.ret %></div>
                        <% } %>
                    </div>

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--维保 e-->

        <!--第二次环保检测 s-->
        <li isload="0" ismassage="0" id="node18" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">第二次环保检测</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-dablebaojiances zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode18">
                <script type="text/template" id="snode18-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 43 ){ %>

                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <% if(item.addtime){ %>
                        <div class="testing_time">检测时间：<%= item.addtime %></div>
                        <% } %>

                        <% if(item.col8){ %>
                        <div class="testing_person">参检人员：<%= item.col8 %></div>
                        <% } %>
                        <!--待定-->
                        <% if(item.col7){ %>
                        <% if(item.col7 == "是"){ %>
                        <div class="testing_person">检测结果：合格</div>
                        <% }else{ %>
                        <div class="testing_person">检测结果：不合格</div>
                        <% } %>

                        <% } %>

                    </div>
                    <div class="auditing_stades">
                        <% if(item.col7 == '是'){ %>
                        <div class="water_minubox clearfix">
                            <div class="fl water_list_tit color_blue"><i class="iconfont icon-right"></i><span>通过</span>
                            </div>
                        </div>
                        <% }else{ %>
                        <div class="water_minubox clearfix">
                            <div class="fl water_list_tit color_organe"><i
                                    class="iconfont icon-tanhaos color_organe"></i><span class="color_organe">未通过</span>
                            </div>
                        </div>
                        <% if(item.remark){ %>
                        <h3 class="fontsize07 color_999 water_list_zgtit">不合格原因：<%= item.remark %></h3>
                        <% } %>
                        <% } %>
                        <div class="water_cont">
                            <% if(item.check_detail.qualified){ %>
                            <ul>
                                <% for(var t = 0;t<item.check_detail.qualified.length;t++){%>
                                <% var items = item.check_detail.qualified[t] %>
                                <li>
                                    <h3 class="h3"><%= t+1 %>：<%= items.title %></h3>
                                    <% if(items.img_yse.length > 1 ){ %>
                                    <div class="company_img_list water_contimg">
                                        <div class="company_imgbox company_imgbox_down">
                                            <div class="company_imgboxcont">
                                                <img src="<%= items.img_yse[1] %>" alt="">
                                            </div>
                                        </div>
                                        <div class="company_imgbox company_imgbox_up">
                                            <div class="company_imgboxcont">
                                                <img src="<%= items.img_yse[0] %>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <% }else{ %>
                                    <div class="company_img_list water_contimg">
                                        <div class="company_imgbox">
                                            <div class="company_imgboxcont">
                                                <img src="<%= items.img_yse[0] %>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <% } %>
                                </li>
                                <% } %>
                            </ul>

                            <% } %>
                        </div>

                    </div>
                    <% } %>
                    <% } %>
                </script>

            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--第二次环保检测 e-->

        <!--环保治理 s-->
        <li isload="0" ismassage="0" id="node19" class="isnodemassage zxnode_list fr">
            <div class="zxnode_list_title clearfix" status="nodeclose">
                <span class="zxnodestatus fl">环保治理</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <i class="iconfont icon-huanbaozhiliss zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode19">
                <script type="text/template" id="snode19-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 49 ){ %>

                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <div class="testing_time">治理时间:&nbsp;<%= item.addtime %></div>
                        <div class="testing_person">参与人员:&nbsp;<%= item.col8 %></div>

                    </div>

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--环保治理 e-->

        <!--环保治理复测 s-->
        <li isload="0" ismassage="0" id="node20" class="isnodemassage zxnode_list fr"
            style="border-left: none;padding-bottom: 3rem;">
            <div class="zxnode_list_title clearfix" status="nodeclose">

                <span class="zxnodestatus fl">环保治理复测</span><i class="iconfont icon-gotonext fr"></i>
            </div>
            <div class="zxnode_logo">
                <div class="nodelastborder"></div>
                <i class="iconfont icon-huanbaozhilifuces zxnode_icon"></i>
                <span class="zxnode_logo_centerbg"></span>
                <p class="zxnode_times">15-10-10</p>
            </div>
            <!--节点内容-->
            <div class="zxnode_list_cont" id="snode20">
                <script type="text/template" id="snode20-cont-template">

                    <% for(var i = 0;i
                    <siteNodeMas.length;i++){%>
                    <% var item = siteNodeMas[i] %>
                    <% if(item.nodeid == 51 ){ %>

                    <div class="review">
                        <% if(item.photo.length>0){ %>
                        <ul class="pre_img clearfix">
                            <% var photos = item.photo %>
                            <% for(var p = 0;p
                            <photos.length
                                    ;p++){ %>
                                <% if(photos.length<1){break;} %>
                                <li class="pre_list fl">
                                    <div class="pre_list_imgbox">
                                        <img src="<%= photos[p] %>" alt="">
                                    </div>
                                </li>
                                <% } %>
                        </ul>
                        <% } %>
                        <!--管家说-->
                        <% if(item.content){ %>
                        <ul class="butler_say">
                            <li class="clearfix butler_say_list">
                                <div class="fl say_logo">
                                    <img src="<%= item.gjphoto %>">
                                </div>
                                <div class="clearfix fl say_text">

                                    <p><span class="color_blue fl">【管家说】</span><%= item.content %></p>
                                </div>
                            </li>
                        </ul>
                        <% } %>
                        <div class="testing_time">治理时间:&nbsp;<%= item.addtime %></div>
                        <div class="testing_person">参与人员:&nbsp;<%= item.col8 %></div>
                        <div class="testing_person">环保复测单位:&nbsp;<%= item.remark %></div>

                    </div>

                    <% } %>
                    <% } %>
                </script>
            </div>
            <!--bottom border-->
            <div class="nodebottombor"></div>
        </li>
        <!--环保治理复测 e-->

    </ul>

</section>
<!--装修节点 e-->
<section class=alert_points_text>评论成功</section>

<!-- 评论文本框 s -->
<section class="critics_text" id="owner_say_cont">
    <div class="critics_text_header clearfix">
        <i class="iconfont icon-error fl"></i>
        <span class="critics_text_title">我要回复</span>
        <i class="iconfont icon-right fr"></i>
    </div>
    <!--<textarea class="critics_text_info" id="critics_text_info"></textarea>-->
    <div class="owner_textcont">
        <textarea class="critics_text_info" id="critics_text_info" maxlength="1000"></textarea>
        <div class="owner_textcont_num"><span>0</span>/1000</div>
    </div>
</section>
<!-- 评论文本框 e -->

<button id="slide-btn"><i class="iconfont icon-openbtn"></i></button>

</body>
</html>
<!--多图提示-->

<!--评论模块-->
<script type="text/template" id="critics-template">
    <% for(var i = 0;i
    <siteNodeMas.length;i++){ %>
    <% var item = siteNodeMas[i] %>
    <% if(item.nodeid == criticsNum ){ %>
    <div class="discuss_title clearfix">
        <div class="discuss_title_l fl">
            <span>最新评论</span><b>(<%= item.message.length %>)</b>
        </div>
        <a class="discuss_title_r fr node_critics_text">写评论</a>
        <input type="hidden" class="nodeid" value="<%= item.nodeid %>">
    </div>
    <% if(item.message.length > 0){ %>

    <ul class="discuss_cont">
        <% for(var j = 0;j
        <item.message.length
        ;j++){ %>
        <% if(j>1){break; } %>
        <% var massageItem = item.message[j]; %>
        <li class="discuss_cont_list clearfix">
            <div class="fl discuss_logo">
                <img src="<%= massageItem.photo %>">
            </div>
            <div class="clearfix fl discuss_text">
                <div class="discuss_text_title clearfix">
                    <div class="discuss_user fl">
                        <div class="discuss_username"><%= massageItem.name %></div>
                        <span class="discuss_ans_time"><%= massageItem.addtime %></span>
                    </div>

                    <a class="write_discuss fr">
                        <i class="iconfont icon-pinglun node_title_reply"></i>
                    </a>
                </div>
                <input type="hidden" value="<%= massageItem.content %>" class="answer_text_input">

                <% var quesTexts = massageItem.content; %>
                <% if(quesTexts.length > 25){ %>
                <% quesTexts = quesTexts.substring(0,25); %>
                    <div class="discuss_text_question answer_text_sub" subtext="1"><%= quesTexts %>···</div>
                <% }else{ %>
                    <div class="discuss_text_question"><%= massageItem.content %></div>
                <% } %>


                <div class="critics_report_massage" style="display: none;">
                    <input type="hidden" class="orderid" value="<%= massageItem.orderid %>">
                    <input type="hidden" class="nodeid" value="<%= massageItem.nodeid %>">
                    <input type="hidden" class="reply_name" value="<%= massageItem.reply_name %>">
                    <input type="hidden" class="parent_id" value="<%= massageItem.parent_id %>">
                    <input type="hidden" class="first_id" value="<%= massageItem.first_id %>">
                    <input type="hidden" class="id_ss" value="<%= massageItem.id %>">
                    <input type="hidden" class="namess" value="<%= massageItem.name %>">
                    <input type="hidden" class="childid1">
                    <input type="hidden" class="childname">

                </div>
                <ul class="discuss_text_answer">
                    <% if(massageItem.reply){ %>
                    <% for(var p = 0;p
                    <massageItem.reply.length
                    ;p++){ %>
                    <% var massageReplays = massageItem.reply[p] %>
                        <li class="discuss_answer_list clearfix">
                            <div class="critics_report_massagetwo" style="display: none;">
                                <% if(p == 0){ %>
                                <input type="hidden" class="childid1" value="<%= massageItem.reply[p].id %>">
                                <% }else{ %>
                                <input type="hidden" class="childid1" value="<%= massageItem.reply[p-1].id %>">
                                <% } %>
                                <input type="hidden" class="childname childnamelist" value="<%= massageReplays.name %>">
                            </div>
                            <div class="fl clearfix">
                                <span class="answer_uname fl"><%= massageReplays.name %>&nbsp;</span>
                                <span class="fl">回复</span>
                                <span class="answer_uname fl">&nbsp;<%= massageReplays.reply_name %>：</span>
                            </div>
                            <input type="hidden" class="answer_text_input" value="<%= massageReplays.content %>">
                            <% var answerTexts = massageReplays.content; %>
                            <% if(answerTexts.length > 25){ %>
                            <% answerTexts = answerTexts.substring(0,25); %>
                            <span class="answer_text answer_text_sub" subtext="1"><%= answerTexts %>···</span>
                            <% }else{ %>
                            <span class="answer_text"><%= massageReplays.content %></span>
                            <% } %>

                            <i class="iconfont icon-pinglun node_child_reply"></i>
                        </li>
                    <% } %>
                    <% } %>
                </ul>
            </div>
        </li>
        <% } %>
        <ol class="critics_list_moretext" isload="0" id="critics-list-moretext<%= criticsNum %>"></ol>
    </ul>
    <% if(item.message.length > 2){ %>
    <a href="javascript:;" class="discuss_more">更多评论</a>
    <% } %>

    <% } %>
    <% } %>
    <% } %>

</script>

<!--评论查看更多-->
<script type="text/template" id="critics-text-more">
    <% for(var i = 0;i
    <siteNodeMas.length;i++){ %>

    <% var item = siteNodeMas[i] %>

    <% if(item.nodeid == criticsNum ){ %>

    <% if(item.message.length > 0){ %>

    <% for(var j = 2;j
    <item.message.length;j++){ %>

    <% var massageItem = item.message[j]; %>
    <li class="discuss_cont_list clearfix">
        <div class="fl discuss_logo">
            <img src="<%= massageItem.photo %>">
        </div>
        <div class="clearfix fl discuss_text">
            <div class="discuss_text_title clearfix">
                <div class="discuss_user fl">
                    <div class="discuss_username"><%= massageItem.name %></div>
                    <span class="discuss_ans_time"><%= massageItem.addtime %></span>
                </div>

                <a class="write_discuss fr">
                    <i class="iconfont icon-pinglun node_title_reply"></i>
                </a>
            </div>
            <input type="hidden" value="<%= massageItem.content %>" class="answer_text_input">
            <% var quesTexts = massageItem.content; %>
            <% if(quesTexts.length > 25){ %>
            <% quesTexts = quesTexts.substring(0,25); %>
            <div class="discuss_text_question answer_text_sub"  subtext="1"><%= quesTexts %>···</div>
            <% }else{ %>
            <div class="discuss_text_question"><%= massageItem.content %></div>
            <% } %>
            <div class="critics_report_massage" style="display: none;">
                <input type="hidden" class="orderid" value="<%= massageItem.orderid %>">
                <input type="hidden" class="nodeid" value="<%= massageItem.nodeid %>">
                <input type="hidden" class="reply_name" value="<%= massageItem.reply_name %>">
                <input type="hidden" class="parent_id" value="<%= massageItem.parent_id %>">
                <input type="hidden" class="first_id" value="<%= massageItem.first_id %>">
                <input type="hidden" class="id_ss" value="<%= massageItem.id %>">
                <input type="hidden" class="namess" value="<%= massageItem.name %>">
                <input type="hidden" class="childid1">
                <input type="hidden" class="childname">

            </div>
            <ul class="discuss_text_answer">
                <% if(massageItem.reply){ %>
                <% for(var p = 0;p
                <massageItem.reply.length
                ;p++){ %>
                <% var massageReplays = massageItem.reply[p] %>
                    <li class="discuss_answer_list clearfix">
                        <div class="critics_report_massagetwo" style="display: none;">
                            <% if(p == 0){ %>
                            <input type="hidden" class="childid1" value="<%= massageItem.reply[p].id %>">
                            <% }else{ %>
                            <input type="hidden" class="childid1" value="<%= massageItem.reply[p-1].id %>">
                            <% } %>
                            <input type="hidden" class="childname childnamelist" value="<%= massageReplays.name %>">
                        </div>
                        <div class="fl clearfix">
                            <span class="answer_uname fl"><%= massageReplays.name %>&nbsp;</span>
                            <span class="fl">回复</span>
                            <span class="answer_uname fl">&nbsp;<%= massageReplays.reply_name %>：</span>
                        </div>
                        <input type="hidden" class="answer_text_input" value="<%= massageReplays.content %>">
                        <% var answerTexts = massageReplays.content; %>
                        <% if(answerTexts.length > 25){ %>
                        <% answerTexts = answerTexts.substring(0,25); %>
                        <span class="answer_text answer_text_sub " subtext="1"><%= answerTexts %>···</span>
                        <% }else{ %>
                        <span class="answer_text "><%= massageReplays.content %></span>
                        <% } %>

                        <i class="iconfont icon-pinglun fl node_child_reply"></i>
                    </li>
                <% } %>
                <% } %>
            </ul>
        </div>
    </li>
    <% } %>

    <% } %>
    <% } %>
    <% } %>

</script>

<section id="big-pic">
    <a class="go-back"><i class="iconfont icon-goback"></i></a>
    <div class="page">
        <div class="pic-local">
            <div class="space_name"></div>
            <div>
                <span id="current-number" class="num"></span>/<span id="total-number" class="num"></span>
            </div>
        </div>
        <div id='slider'>
            <ul id="big-pic-content">
                <!-- <li class="single-pic">
                    <div class="pic-info">
                        <img src="img/big_img.png" alt="图片">
                        <div class="pic-local"><span class="num">1</span>/<span class="num">7</span></div>
                    </div>
                </li>
                <li class="single-pic">
                    <div class="pic-info">
                        <img src="img/frog.jpg" alt="图片">
                        <div class="pic-local"><span class="num">1</span>/<span class="num">7</span></div>
                    </div>
                </li>
                <li class="single-pic">
                    <div class="pic-info">
                        <img src="img/case2.png" alt="图片">
                        <div class="pic-local"><span class="num">1</span>/<span class="num">7</span></div>
                    </div>
                </li>
                <li class="single-pic">
                    <div class="pic-info">
                        <img src="img/case3.png" alt="图片">
                        <div class="pic-local"><span class="num">1</span>/<span class="num">7</span></div>
                    </div>
                </li> -->
            </ul>
        </div>
    </div>
</section>

<script type="text/template" id="big-pic-data">
    <% for(var j=0; j < alertImg.img_yses.length; j++){ %>
    <% var every = alertImg.img_yses[j] %>
    <li class="single-pic">
        <div class="pic-info">
            <img class="lazy-bimg" src=<%= every %>>
            <div class="loader"></div>
        </div>
    </li>
    <% } %>
</script>

<script type="text/template" id="big-pic1-data">
    <% for(var j=0; j < alertImg1.length; j++){ %>
    <% var every = alertImg1[j] %>
    <li class="single-pic">
        <div class="pic-info">
            <img class="lazy-bimg" src=<%= every %>>
            <div class="loader"></div>
        </div>
    </li>
    <% } %>
</script>

<!--yezhushuo start-->
<script type="text/template" id="owner_say_templete">
    <% if(ownerAddDataStatus == 0){ %>
        <% for(var i = 0;i<siteNodeMas.length;i++){ %>
            <% var item = siteNodeMas[i] %>
            <% if(item.nodeid == ownerSayScoreData.NODEID ){ %>
                <% if(!item.owner_speak){ %>
                    <div class="write_logbox">
                        <div class="write_log">
                            <i class="iconfont icon-biji-copy-copy"></i><span>写日志</span>
                        </div>
                    </div>
                    <!--业主说-->
                <% } %>
                <% if(item.owner_speak){ %>
                <ul class="butler_say">
                    <li class="clearfix butler_say_list">
                        <div class="fl say_logo">
                            <img src="<%= item.user_photo %>">
                        </div>
                        <div class="clearfix fl say_text">
                            <p><span class="color_organe fl">【业主说】</span><span class="spak_text_wz"><%= item.owner_speak %></span></p>
                        </div>
                    </li>
                </ul>

                <div class="owner_textbutton owner_say_button">
                    <a class="color_blue revise" href="javascript:;">编辑</a>
                    <a class="color_blue output" href="javascript:;">删除</a>
                </div>
                <% } %>
            <% } %>
        <% } %>
    <% }else{ %>
        <% if(!owner_data.owner_speak){ %>
        <div class="write_logbox">
            <div class="write_log">
                <i class="iconfont icon-biji-copy-copy"></i><span>写日志</span>
            </div>
        </div>
        <!--业主说-->
        <% } %>
        <% if(owner_data.owner_speak){ %>
        <ul class="butler_say">
            <li class="clearfix butler_say_list">
                <div class="fl say_logo">
                    <img src="<%= owner_data.user_photo %>">
                </div>
                <div class="clearfix fl say_text">
                    <p><span class="color_organe fl">【业主说】</span><span class="spak_text_wz"><%= owner_data.owner_speak %></span></p>
                </div>
            </li>
        </ul>

        <div class="owner_textbutton owner_say_button">
            <a class="color_blue revise" href="javascript:;">编辑</a>
            <a class="color_blue output" href="javascript:;">删除</a>
        </div>
        <% } %>
    <% } %>
</script>
<!--yezhushuo end-->

<!--pingfen start-->
<script type="text/template" id="score_star_templete">
    <% for(var i = 0;i<siteNodeMas.length;i++){ %>
        <% var item = siteNodeMas[i] %>
        <% if(item.nodeid == ownerSayScoreData.NODEID ){ %>
           <!-- <% if(item.grade.serve == 0){ %>
                <a class="score_link" href="mobile-score.html?nodeid=<%= item.nodeid %>&orderid=<%= urlordadeId %>" ></a>
            <% } %>-->
            <% var staritem = item.grade %>
            <% if(staritem.quality == 0){break;} %>
            <div class="scores_title">水电工程验收服务评分</div>
             <ul class="scor_mode">
                <li class="sc_cont">
                    <div class="sc_title">装修公司评分</div>
                    <div class="sc_button">
                        <ol>
                            <% if(item.nodeid == 37){ %>
                            <li class="start_button">
                                <span class="start_name">设计水平</span>
                                <div class="start_cont outcome" name="design" number="<%= staritem.design %>">
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                </div>
                                <span class="start_num color_red">请评分</span>
                            </li>
                            <% } %>
                            <li class="start_button">
                                <span class="start_name">施工质量</span>
                                <div class="start_cont outcome" name="quality" number="<%= staritem.quality %>">
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                </div>
                                <span class="start_num color_red">请评分</span>
                            </li>

                            <li class="start_button">
                                <span class="start_name">服务态度</span>
                                <div class="start_cont outcome" name="manner" number="<%= staritem.manner %>">
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                </div>
                                <span class="start_num color_red">请评分</span>
                            </li>

                            <li class="start_button">
                                <span class="start_name">施工时效</span>
                                <div class="start_cont outcome" name="capacity" number="<%= staritem.capacity %>">
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                </div>
                                <span class="start_num color_red">请评分</span>
                            </li>
                        </ol>
                    </div>
                </li>

                <li class="sc_cont">
                    <div class="sc_title">装修管家评分</div>
                    <div class="sc_button">
                        <ol>
                            <li class="start_button">
                                <span class="start_name">专业技能</span>
                                <div class="start_cont outcome" name="professional" number="<%= staritem.professional %>">
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                </div>
                                <span class="start_num color_red">请评分</span>
                            </li>

                            <li class="start_button">
                                <span class="start_name">服务态度</span>
                                <div class="start_cont outcome" name="serve" number="<%= staritem.serve %>">
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                </div>
                                <span class="start_num color_red">请评分</span>
                            </li>

                            <li class="start_button">
                                <span class="start_name">协调能力</span>
                                <div class="start_cont outcome" name="coordinate" number="<%= staritem.coordinate %>">
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                    <i class="iconfont icon-star_one"></i>
                                </div>
                                <span class="start_num color_red">请评分</span>
                            </li>
                        </ol>
                    </div>
                </li>
                <% if(staritem.serve != 0){ %>
                <li>
                    <ol class="owner_text">
                        <li class="own_li">
                            <div class="owner_text_title">业主评价</div>
                            <% if(staritem.content != ''){ %>
                                <p><%= staritem.content %></p>
                            <% } %>
                        </li>
                        <div class="owner_zhuip">
                            <% if(staritem.additional != ''){ %>
                                <div class="owner_text_title color_blue">业主追评</div>
                                <p><%= staritem.additional %></p>
                            <% } %>
                        </div>

                    </ol>
                    <div style="height: 0.7rem;"></div>
                   <!-- <% if(staritem.additional_num == 0 || staritem.modification_num == 0){ %>
                    <div class="owner_textbutton">
                        <% if(staritem.additional_num == 0){ %>
                            <a class="addratings color_blue" href="javascript:;">追加评价</a>
                        <% } %>

                        <% if(staritem.modification_num == 0){ %>
                        <a class="modify_score color_blue" href="mobile-score.html?nodeid=<%= item.nodeid %>&orderid=<%= urlordadeId %>&upda=1">修改评分</a>
                        <% } %>
                    </div>
                    <% }else{ %>
                        <div style="height: 0.7rem;"></div>
                    <% } %>-->
                </li>
                <% } %>
            </ul>
            <% } %>
    <% } %>
</script>

<script  type="text/template" id="score_ratings_templete">
    <% if(addratingsData.additional != ''){ %>
        <div class="owner_text_title color_blue">业主追评</div>
        <p><%= addratingsData.additional %></p>
        <div style="height: 0.7rem;"></div>
    <% } %>
</script>
<!--pingfen end-->
<script src="<?php echo R;?>msite/base/js/zepto.min.js"></script>
<script src="<?php echo R;?>msite/base/js/size.js"></script>
<script src="<?php echo R;?>msite/base/js/underscore-template.js"></script>
<script src="<?php echo R;?>msite/base/js/base.js"></script>
<script src="<?php echo R;?>msite/base/js/swipe.js"></script>
<script src="<?php echo R;?>msite/base/js/pinchzoom.min.js"></script>
<script src="<?php echo R;?>msite/building_live_new/js/fastclick.js"></script>
<script src="<?php echo R;?>msite/building_live_new/js/building_new.min.js"></script>



