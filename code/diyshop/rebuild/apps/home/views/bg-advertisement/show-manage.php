<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('首页男女装图片');
$this->registerAssetBundle('common\assets\AjaxUploadAsset');
?>
<style type="text/css">
	.list-group-item{
		width:375px;
		height:298px;
		float:left;
		margin:10px;
	}
	.list-group-item img{
		width:375px;
		height:200px;
	}
</style>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '首页男女装图片',
				'url' => Url::to(['bg-advertisement/show-manage-advertisement']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">管理首页男女装图片</h1>
	</div>
</div>

<div class="J-advertisement-config row">
	<div class="col-lg-12" style="border:1px solid #ccc;margin-bottom:10px;">
		<div class="form-group">
			<h1>男装图片</h1>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-pics-list_boy list-group"></ul>
				</div>
			</div>
		</div>
		<br />
		<div class="form-group">
			<button type="button" data-id="boy" class="J-form-upload-btn_boy btn btn-primary">添加男装图片</button>
		</div>
	</div>
	<div class="col-lg-12" style="border:1px solid #ccc;margin-bottom:10px;">
		<div class="form-group">
			<h1>女装图片</h1>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-pics-list_girl list-group"></ul>
				</div>
			</div>
		</div>
		<br />
		<div class="form-group">
			<button type="button" data-id="girl" class="J-form-upload-btn_girl btn btn-primary">添加女装图片</button>
		</div>
	</div>
</div>
<br />
<div class="row">
	<div class="form-group">
		<button type="button" class="J-form-save-btn btn btn-primary" onclick="save(this);">保存设置</button>
	</div>
</div>
<script type="text/javascript">
	var aBgAdvertisementConfig = <?php echo json_encode($aBgAdvertisementConfig); ?>;
	
	function bulidImgHtml(pic, url){
		var htmlStr = '\
			<li class="list-group-item" data-pic="' + pic + '">\
				<p><img class="img-thumbnail" src="' + App.url.resource + pic + '" alt=""></p>\
				<p><center><button type="button" class="btn btn-sm btn-danger" onclick="deletePic(this);">删除</button></center></p>\
			</li>\
		';
		return htmlStr;
	}
	
	function save(o){
		var boyPic = $('.J-pics-list_boy .list-group-item').attr('data-pic');
		var girlPic = $('.J-pics-list_girl .list-group-item').attr('data-pic');
		ajax({
			url : '<?php echo Url::to(['bg-advertisement/save-advertisement-config']); ?>',
			data : {
				aData : [boyPic, girlPic]
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
	
	function deletePic(o){
		$(o).parent().parent().remove();
	}
	
	$(function(){
		<?php if($aBgAdvertisementConfig){ ?>
			$('.J-pics-list_boy').append(bulidImgHtml(aBgAdvertisementConfig[0]));
			$('.J-pics-list_girl').append(bulidImgHtml(aBgAdvertisementConfig[1]));
		<?php } ?>
		$('.J-form-upload-btn_boy').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['bg-advertisement/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					$('.J-pics-list_boy').html('');
					$('.J-pics-list_boy').append(bulidImgHtml(aResult.data));
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
		$('.J-form-upload-btn_girl').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['bg-advertisement/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					$('.J-pics-list_girl').html('');
					$('.J-pics-list_girl').append(bulidImgHtml(aResult.data));
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	});
</script>