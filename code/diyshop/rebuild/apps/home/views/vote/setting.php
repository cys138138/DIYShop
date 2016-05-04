<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
$this->setTitle('投票');
$this->registerAssetBundle('common\assets\AjaxUploadAsset');
?>
<style type="text/css">
	.J-pic-wraper{
		width:375px;
		height:264px;
		display:none;
	}
	.J-pic-wraper img{
		width:375px;
		height:234px;
	}
</style>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '投票列表',
				'url' => Url::to(['vote/show-list']),
			],
			[
				'title' => '添加投票',
				'url' => Url::to(['vote/show-setting']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">添加投票</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<label>投票说明</label>
			<textarea class="J-description form-control" rows="3" placeholder="请输入投票说明"></textarea>
			<br />
		</div>
		<div class="form-group">
			<button type="button" class="J-form-upload-btn btn btn-primary">上传投票图片</button>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="J-pic-wraper col-lg-12"></div>
			</div>
		</div>
		<br />
		<div class="form-group">
			<button type="button" class="J-save-btn btn btn-primary" onclick="save(this);">保存</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	var currentPic = '';
	
	function save(o){
		var description = $('.J-description').val();
		if(description == ''){
			UBox.show('请输入投票说明', -1);
			return;
		}
		ajax({
			url : '<?php echo Url::to(['vote/save-setting']); ?>',
			data : {
				description : description,
				pic : currentPic
			},
			beforeSend : function(){
				$(o).attr('disabled', 'disabled');
			},
			complete : function(){
				$(o).attr('disabled', false);
			},
			success : function(aResult){
				UBox.show(aResult.msg, aResult.status, function(){
					location.href = '<?php echo Url::to(['vote/show-list']); ?>';
				}, 3);
			}
		});
	}
	
	$(function(){
		$('.J-form-upload-btn').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['vote/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					currentPic = aResult.data;
					$('.J-pic-wraper').html('<p><img class="img-thumbnail" src="' + App.url.resource + currentPic + '" alt=""></p>');
					$('.J-pic-wraper').show();
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	});
</script>