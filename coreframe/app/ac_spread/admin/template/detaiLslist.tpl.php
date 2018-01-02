	      <tr class="showLslist">
	          <td  colspan="5">
	             <table style="border:1px solid #add9c0;position:relative;left: 138px;" class="table table-striped table-advance table-hover" border="1">
	               <tr style="border:1px solid #add9c0;">
		               	<th style="text-align: center;">页面类型</th>
                       <th style="text-align: center;">活动名称</th>
                       <th style="text-align: center;">渠道数</th>
		          	    <th style="text-align: center;" colspan="3">管理操作</th>
		          	    <th style="text-align: center;">链接</th>
                       <th style="text-align: center;">创建时间</th>
	               </tr>
	               <?php foreach ($arr['pc'] as $key => $ar) { ?>
		          	   <tr style="border:1px solid #add9c0;" id='<?php echo $ar['did']?>'>
		          	   	    <td style="text-align: center;"><?php echo $ar['title']?></td>
                           <td style="text-align: center;"><?php echo $ar['activityname']?></td>
                           <td style="text-align: center;"><?php echo $ar['channel_num'] ?></td>
		          	   	    <td style="text-align: center;background-color: #1EA722;cursor: pointer;color: aliceblue;">
		          	   	    <span attr-type="<?php echo $ar['type']?>" attr-id='<?php echo $ar['m_id']?>' custom_url = '<?php echo $ar['custom_url'] ?>' attr-eid=<?php echo $ar['did']?>  class="wuzhi-edit">编辑</span>

		          	   	    </td>
		          	   	    <td style="text-align: center;background-color: #EF2323;cursor: pointer;color: aliceblue;">
		          	   	    <span attr-id='<?php echo $ar['m_id']?>' attr-status='-1' attr-message='删除' attr-type="<?php echo $ar['type']?>" attr-did=<?php echo $ar['did']?> class="wuzhi-delete">删除</span>
		          	   	    </td>
                           <td style="text-align: center;background-color: #23adef;cursor: pointer;color: aliceblue;">
                              <span><a href="?m=workitems&f=workitem&v=channelEdit&id=<?php echo $ar['m_id']; echo $this->su()?>&type=<?php echo $ar['type']?>&c_id=<?php echo $ar['exercise_id']?>"  attr-id='<?php echo $ar['m_id']?>' attr-status='-1' attr-message='渠道推广' style="color: #ffffff" >渠道推广</a></span>
                           </td>

		          	   	    <td style="width: 457px;">
                                <?php if($ar['type'] == 1){  ?>
                                <?php if($ar['custom_url']){ ?>
                                 <a target="_blank"  href="<?php echo $ar['custom_url']?>"><?php echo $ar['custom_url']?></a>
                                <?php }else{?>
                                <a target="_blank" href="http://www.uzhuang.com/huodong-<?php echo $ar['id']?>-<?php echo $ar['m_id'] ?>.html">http://www.uzhuang.com/huodong-<?php echo $ar['id']?>-<?php echo $ar['m_id'] ?>.html</a>
                                    <?php }?>
                                <?php }else{?>
                                <?php if($ar['custom_url']){ ?>
                                        <a target="_blank" href="<?php echo $ar['custom_url']?>"><?php echo $ar['custom_url']?></a>
                                <?php }else{?>
                                    <a target="_blank" href="<?php $str=R;$newstr = substr($str,0,strlen($str)-5);
                                    echo $newstr.'/mobile-temp_new.html?activity_id='.$ar['m_id'];?>"><?php $str=R;$newstr = substr($str,0,strlen($str)-5);
                                        echo $newstr.'/mobile-temp_new.html?activity_id='.$ar['m_id'];?></a>
                                    <?php }?>
                                <?php }?>
                            </td>
                           <td style="text-align: center;"><?php echo $ar['addtime']?></td>
		          	   </tr>
	          	   <?php  }?>
                     <?php foreach ($arr['m'] as $key => $ar) { ?>
                         <tr style="border:1px solid #add9c0;" id='<?php echo $ar['did']?>'>
                             <td style="text-align: center;"><?php echo $ar['title']?></td>
                             <td style="text-align: center;"><?php echo $ar['activityname']?></td>
                             <td style="text-align: center;"><?php echo $ar['channel_num'] ?></td>
                             <td style="text-align: center;background-color: #1EA722;cursor: pointer;color: aliceblue;">
                                 <span attr-type="<?php echo $ar['type']?>" attr-id='<?php echo $ar['m_id']?>' custom_url = '<?php echo $ar['custom_url'] ?>' attr-eid=<?php echo $ar['did']?>  class="wuzhi-edit">编辑</span>

                             </td>
                             <td style="text-align: center;background-color: #EF2323;cursor: pointer;color: aliceblue;">
                                 <span attr-id='<?php echo $ar['m_id']?>' attr-status='-1' attr-message='删除' attr-type="<?php echo $ar['type']?>" attr-did=<?php echo $ar['did']?> class="wuzhi-delete">删除</span>
                             </td>
                             <td style="text-align: center;background-color: #23adef;cursor: pointer;color: aliceblue;">
                                 <span><a href="?m=workitems&f=workitem&v=channelEdit&id=<?php echo $ar['m_id']; echo $this->su()?>&type=<?php echo $ar['type']?>&c_id=<?php echo $ar['exercise_id']?>"  attr-id='<?php echo $ar['m_id']?>' attr-status='-1' attr-message='渠道推广' style="color: #ffffff" >渠道推广</a></span>
                             </td>

                             <td style="width: 457px;">
                                 <?php if($ar['type'] == 1){  ?>
                                     <?php if($ar['custom_url']){ ?>
                                         <a target="_blank"  href="<?php echo $ar['custom_url']?>"><?php echo $ar['custom_url']?></a>
                                     <?php }else{?>
                                         <a target="_blank" href="http://www.uzhuang.com/huodong-<?php echo $ar['id']?>-<?php echo $ar['m_id'] ?>.html">http://www.uzhuang.com/huodong-<?php echo $ar['id']?>-<?php echo $ar['m_id']  ?>.html</a>
                                     <?php }?>
                                 <?php }else{?>
                                     <?php if($ar['custom_url']){ ?>
                                         <a target="_blank" href="<?php echo $ar['custom_url']?>"><?php echo $ar['custom_url']?></a>
                                     <?php }else{?>
                                         <a target="_blank" href="<?php $str=R;$newstr = substr($str,0,strlen($str)-5);
                                         echo $newstr.'/mobile-temp_new.html?activity_id='.$ar['m_id'];?>"><?php $str=R;$newstr = substr($str,0,strlen($str)-5);
                                             echo $newstr.'/mobile-temp_new.html?activity_id='.$ar['m_id'];?></a>
                                     <?php }?>
                                 <?php }?>
                             </td>
                             <td style="text-align: center;"><?php echo $ar['addtime']?></td>
                         </tr>
                     <?php  }?>
	          	</table>
	          </td>
		  </tr>
