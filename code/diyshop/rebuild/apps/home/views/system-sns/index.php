<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
$this->setTitle('系统通知');
?>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '系统通知',
				'url' => Url::to(['system-sns/index']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">发送系统通知</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<label>用户手机号</label>
			<input class="J-mobile form-control" placeholder="选填" value="" style="width:500px;">
			<br />
		</div>
		<div class="form-group">
			<label>内容</label>
			<textarea class="J-content form-control" placeholder="选填" value="" style="width:500px;height:200px;"></textarea>
			<br />
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<button type="button" class="btn btn-primary" onclick="sendSystemSns(this);">发送系统通知</button>
		</div>
	</div>
</div>

<script type="text/javascript">
	function sendSystemSns(o){
		ajax({
			url : '<?php echo Url::to(['system-sns/send-system-sns']); ?>',
			data : {
				mobile : $('.J-mobile').val(),
				content : $('.J-content').val()
			},
			beforeSend : function(){
				$(o).attr('disabled', 'disabled');
			},
			complete : function(){
				$(o).attr('disabled', false);
			},
			success : function(aResult){
				UBox.show(aResult.msg, aResult.status);
			}
		});
	}
	
	$(function(){
		
	});
</script>