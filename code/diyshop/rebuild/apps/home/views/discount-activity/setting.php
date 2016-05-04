<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
$this->setTitle('优惠活动');
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
				'title' => '优惠活动列表',
				'url' => Url::to(['discount-activity/show-list']),
			],
			[
				'title' => '添加优惠活动',
				'url' => Url::to(['discount-activity/show-setting']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">添加优惠活动</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<label>活动链接</label>
			<input class="J-link-url form-control" placeholder="请输入活动链接" value="">
			<br />
		</div>
		<div class="form-group">
			<button type="button" class="J-form-upload-btn btn btn-primary">上传活动图片</button>
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
		var linkUrl = $('.J-link-url').val();
		if(linkUrl == ''){
			UBox.show('请输入活动链接', -1);
			return;
		}
		ajax({
			url : '<?php echo Url::to(['discount-activity/save-setting']); ?>',
			data : {
				linkUrl : linkUrl,
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
					location.href = '<?php echo Url::to(['discount-activity/show-list']); ?>';
				}, 3);
			}
		});
	}
	
	$(function(){
		$('.J-form-upload-btn').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['discount-activity/upload-file']); ?>',
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