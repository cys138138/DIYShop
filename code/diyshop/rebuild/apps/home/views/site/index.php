<?php
use umeworld\lib\Url;
$this->setTitle('DiyShop首页');
?>
<style type="text/css">
	.J-body-row{
		height:260px;
		width:600px;
		margin:0 auto;
	}
	.panel-body{
		height:200px;
		font-size: 25px;
	}
	
	.panel-body center{
		margin-top:60px;
	}
	
	.J-link-panel{
		width:260px;
		cursor:pointer;
	}
</style>
<br />
<br />
<br />
<div class="row1">
	<div class="J-body-row">
		<div class="J-link-panel col-sm-4" style="float:left;" onclick="gotoPage('<?php echo Url::to(['manager/index']); ?>');">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h3 class="panel-title">&nbsp;</h3>
				</div>
				<div class="panel-body">
					<center style="color:#5cb85c;">我是管理员</center>
				</div>
			</div>
		</div>
		<div class="J-link-panel col-sm-4" style="float:right;" onclick="gotoPage('<?php echo Url::to(['vender/index']); ?>');">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<h3 class="panel-title">&nbsp;</h3>
				</div>
				<div class="panel-body">
					<center style="color:#f0ad4e;">我是商家</center>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function gotoPage(url){
		location.href = url;
	}
</script>
