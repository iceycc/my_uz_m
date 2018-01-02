<form name="myform" class="form-horizontal tasi-form" id="form6" action="?m=MShouYe&f=homepage_log&v=intervenes_log&orderid=<?php echo $result['orderid'];?><?php echo $this->su();?>" method="post">

权重值：<input name="log_intervene" id="zhi" value=" <?php echo $result['log_intervene']?>"><br>
    <label style="width: 150px;" class="col-sm-1 control-label layui-inline"><span">推广截止时间：</span></label><input type="text" class="layui-input time-begin" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss '})" placeholder="推广截止时间" style="width:160px"  name="deadline_m_time" id="deadline_m_time"  value="<?php echo $result['deadline_m_time']?>"/>


<br><input name="submit" type="submit"  class="save-bt btn btn-info" id="bao" value="确认"> &nbsp;&nbsp;&nbsp;
<!-- <a href="?m=Mjin&f=content&v=intervenes&id=<?php echo $result['id']?><?php echo $this->su();?>">ccccc</a>
</form> -->
</form>
<script src="<?php echo R;?>js/layui/layui.js"></script>
<script src="<?php echo R;?>js/layui/jquery.js"></script>
<script type="text/javascript">
    $(function(){
        $(".form-horizontal").Validform({
            tiptype:3
        });
    });
    layui.use('laydate', function(){
        var laydate = layui.laydate;
    });
    $('#bao').click(function () {
        var  deadline_m_time =  $("#deadline_m_time").val();
        if(deadline_m_time == null || deadline_m_time == undefined || deadline_m_time == ''){
            alert('请填写推广时间');return false;
        }

    })

</script>
