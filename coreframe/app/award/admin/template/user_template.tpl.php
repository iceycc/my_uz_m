    <?php if($status == 1){?>
        <span class='total'>共<label><?php echo $total?></label>条提取历史</span>
        <div class="panel-body" id="panel-bodys">
            <table class="table table-striped table-advance table-hover">
               <thead>
                 <tr>
                   <th style="background-color: #D4D8DC;font-size: 20px;">编号</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">提取金额</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">银行卡</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">申请时间</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">打款时间</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">审核状态</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">审核人员</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">打款状态</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">管理操作</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">备注</th>
                 </tr>
               </thead>
               <tbody>
                 <?foreach ($extract as $key => $va) {?>
                   <tr>
                    <td><?php echo $va['stream_no']?></td>
                    <td><?php echo $va['money']?></td>
                    <td><?php echo $va['bank_name'].$va['bank_number']?></td>
                    <td><?php echo date('Y-m-d H:i:s',$va['addtime']);?></td>
                    <td><?php echo $va['pay_time']?></td>
                    <td class="status"><?php echo $va['status']?></td>
                    <td class="operator"><?php echo $va['operator']?></td>
                    <td><?php echo $va['money_status']?></td>
                    <td style="width: 209px;"> 
                       <span class="check <?php echo $va['nocheck']?> y" onclick='check_y(<?php echo $va['id']?>,this)'>审核通过</span>
                       <span class="check <?php echo $va['nocheck']?> n"  onclick='check_n(<?php echo $va['id']?>,this)'>审核未通过</span>
                    </td>
                    <td class="remark"><?php echo $va['reason']?></td>
                   </tr>
                 <?}?>
               </tbody>
            </table>
             
        </div>
    <?}else if($status == 2){?>
        <span class='total'>共推荐<label><?php echo $total?></label>次,成功上门量房<label><?php echo $win?></label>次</span>
         <div class="panel-body" id="panel-bodys">
            <table class="table table-striped table-advance table-hover">
               <thead>
                 <tr>
                   <th style="background-color: #D4D8DC;font-size: 20px;">序号</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">姓名</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">电话</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">地址</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">面积（㎡）</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">预算（万元）</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">推荐时间</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">量房管家</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">状态</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">是否获得返现</th>
                 </tr>
               </thead>
               <tbody>
                  <? if(!empty($demand_code)){
                  foreach ($demand_code as $key => $va) {?>
                    <tr>
                       <td><?php echo $key+1;?></td>
                       <td><?php echo $va['nickname']?></td>
                       <td><?php echo $va['mobile']?></td>
                       <td><?php echo $va['address']?></td>
                       <td><?php echo $va['area'].'（㎡）'?></td>
                       <td><?php echo $va['budget'].'（万元）'?></td>
                       <td><?php echo $va['addtime']?></td>
                       <td><?php echo $va['gjname']?></td>
                       <td><?php echo $va['orderStatus']?></td>
                       <td><?php echo $va['status']?></td>
                    </tr>
                  <?}}?>
               </tbody>
            </table>
         </div>
    <?}else if($status == 3){?> 
        <span class='total'>共邀请好友<label><?php echo $total?></label>名,之后成功推荐量房<label><?php echo $yroom?></label>次</span>
        <table class="table table-striped table-advance table-hover">
               <thead>
                 <tr>
                   <th style="background-color: #D4D8DC;font-size: 20px;">序号</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">昵称</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">电话</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">推荐量房次数</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">成功量房次数</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">注册时间</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">获得返现</th>
                   <th style="background-color: #D4D8DC;font-size: 20px;">管理操作</th>
                 </tr>
               </thead>
               <tbody>
                 <?foreach ($fcode as $key => $va) {?>
                    <tr>
                       <td><?php echo $key+1;?></td>
                       <td><?php echo $va['nickname']?></td>
                       <td><?php echo $va['mobile']?></td>
                       <td><?php echo $va['codesum']?></td>
                       <td><?php echo $va['ycode']?></td>
                       <td><?php echo date('Y-m-d H:i:s',$va['addtime'])?></td>
                       <td><?php echo $va['ycode'] * 50?></td>
                       <td><span class="check x" uid="<?php echo $va['uid']?>">详情</span></td>
                    </tr>
                 <? }?>
                 <?php if(!$fcode){ ?>
                    <tr>
                       <td colspan="8" style="text-align:center;font-size:30px;font-family:microsoft yahei;">暂无数据</td>
                    </tr>
                 <?php } ?>
               </tbody>
            </table>
    <?}?>
    <div class="panel-body">
         <div class="row">
             <div class="col-lg-12">
                 <div class="pull-right">
                     <ul class="pagination pagination-sm mr0">
                         <?php echo $pages;?>
                     </ul>
                 </div>
             </div>
         </div>
    </div>