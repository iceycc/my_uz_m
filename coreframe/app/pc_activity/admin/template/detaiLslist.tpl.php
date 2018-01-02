	      <tr class="showLslist">
	          <td  colspan="5">
	             <table style="border:1px solid #add9c0;position:relative;left: 138px;" class="table table-striped table-advance table-hover" border="1">
	               <tr style="border:1px solid #add9c0;">
		               	<th style="text-align: center;">页面类型</th>
		          	    <th style="text-align: center;" colspan="2">管理操作</th>
		          	    <th style="text-align: center;">链接</th>
	               </tr>
	               <?php foreach ($arr as $key => $ar) { ?>
		          	   <tr style="border:1px solid #add9c0;" id='<?php echo $ar['did']?>'>
		          	   	    <td style="text-align: center;"><?php echo $ar['title']?></td>
		          	   	    <td style="text-align: center;background-color: #1EA722;cursor: pointer;color: aliceblue;">
		          	   	    <span attr-type="<?php echo $ar['type']?>" attr-id='<?php echo $ar['id']?>' attr-eid=<?php echo $ar['did']?> class="wuzhi-edit">编辑</span>
		          	   	    </td>
		          	   	    <td style="text-align: center;background-color: #EF2323;cursor: pointer;color: aliceblue;">
		          	   	    <span attr-id='<?php echo $ar['id']?>' attr-status='-1' attr-message='删除' attr-type="<?php echo $ar['type']?>" attr-did=<?php echo $ar['did']?> class="wuzhi-delete">删除</span>
		          	   	    </td>
		          	   	    <td style="text-align: center;width: 457px;"><a target="_blank" href="http://www.uzhuang.com/huodong-<?php echo $ar['id']?>.html">http://www.uzhuang.com/huodong-<?php echo $ar['id']?>.html</a></td>
		          	   </tr>
	          	   <?php  }?>
	          	</table>
	          </td>
		  </tr>
