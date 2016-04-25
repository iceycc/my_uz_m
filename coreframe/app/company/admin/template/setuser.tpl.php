<?php defined('IN_WZ') or exit('No direct script access allowed');?>
<?php
include $this->template('header','core');
?>
<body class="body pxgridsbody">
<section class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<?php echo $this->menu($GLOBALS['_menuid']);?>

				<div class="panel-body" id="formid">
					<form class="form-horizontal tasi-form" method="post" action="">
						<div class="form-group">
							<label class="col-sm-2 control-label">用户名</label>
							<div class="col-sm-4">
								<input type="text" value="" class="form-control" id="username" name="username" size="20" maxlength="20">
							</div>
						</div>


						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-10">
								<input class="btn btn-info" id="submit" type="submit" name="submit" value="提交">
							</div>
						</div>
					</form>
				</div>

			</section>
		</div>

	</div>
</section>

<script src="<?php echo R;?>js/bootstrap.min.js"></script>
<script src="<?php echo R;?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo R;?>js/pxgrids-scripts.js"></script>

