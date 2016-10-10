<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('首页轮播图片');
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
				'title' => '首页轮播图片',
				'url' => Url::to(['top-advertisement/show-manage-advertisement']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">管理首页轮播图片</h1>
	</div>
</div>

<div class="J-advertisement-config row">
	<div class="col-lg-12" style="border:1px solid #ccc;margin-bottom:10px;">
		<div class="form-group">
			<h1>轮播图片</h1>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-pics-list list-group"></ul>
				</div>
			</div>
		</div>
		<br />
		<div class="form-group">
			<button type="button" data-id="top" class="J-form-upload-btn_top btn btn-primary">添加轮播图片</button>
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
	var aTopAdvertisementConfig = <?php echo json_encode($aTopAdvertisementConfig); ?>;
	
	function bulidImgHtml(pic, url){
		var htmlStr = '\
			<li class="list-group-item" data-pic="' + pic + '">\
				<p><img class="img-thumbnail" src="' + App.url.resource + pic + '" alt=""></p>\
				<p><center><button type="button" class="btn btn-sm btn-danger" onclick="deletePic(this);">删除</button></center></p>\
			</li>\
		';
		return htmlStr;
	}
	
	function getPics(){
		var aPics = [];
		/*if($('.J-pics-list li').length == 0){
			UBox.show('请上传服饰图片', -1);
			return false;
		}*/
		$('.J-pics-list li').each(function(){
			aPics.push($(this).attr('data-pic'));
		});
		
		return aPics;
	}
	
	function save(o){
		var aPic = getPics();
		ajax({
			url : '<?php echo Url::to(['top-advertisement/save-advertisement-config']); ?>',
			data : {
				aData : aPic
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
	
	$(function(){console.log(aTopAdvertisementConfig);
		if(aTopAdvertisementConfig.length != 0){
			for(var i in aTopAdvertisementConfig){
				$('.J-pics-list').append(bulidImgHtml(aTopAdvertisementConfig[i]));
			}
		}
		$('.J-form-upload-btn_top').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['top-advertisement/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					$('.J-pics-list').append(bulidImgHtml(aResult.data));
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	});
</script>