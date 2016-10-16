<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('饰件管理');
$this->registerAssetBundle('common\assets\AjaxUploadAsset');
?>
<style type="text/css">
	#wrapper .J-pic-item{
		width:375px;
		height:298px;
		float:left;
		margin:2px;
	}
	#wrapper .J-pic-item img, #wrapper .J-effect-pic{
		width:375px;
		height:234px;
	}
</style>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '饰件列表',
				'url' => Url::to(['manager-dress-decoration/show-list']),
			],
			[
				'title' => $aDressDecoration ? '编辑饰件' : '添加饰件',
				'url' => Url::to(['manager-dress-decoration/show-edit']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $aDressDecoration ? '编辑饰件' : '添加饰件'; ?></h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<input class="J-id form-control" type="hidden" value="<?php echo $aDressDecoration ? $aDressDecoration['id'] : ''; ?>">
			<label>饰件名称</label>
			<input class="J-name form-control" placeholder="饰件名称" value="<?php echo $aDressDecoration ? $aDressDecoration['name'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<label>饰件价格</label>
			<input class="J-price form-control" placeholder="饰件价格" value="<?php echo $aDressDecoration ? $aDressDecoration['price'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<label>饰件详细图片</label>
			<div class="form-group">
				<button type="button" class="J-add-detail-pics-btn btn btn-info">上传饰件详细图片</button>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-detail-pics-list list-group"></ul>
				</div>
			</div>
			<br />
		</div>
		<br />
		<div class="form-group">
			<label>饰件效果图片</label>
			<div class="form-group">
				<img class="J-effect-pic img-thumbnail" data-pic="<?php echo $aDressDecoration ? $aDressDecoration['effect_pic'] : ''; ?>" src="<?php echo $aDressDecoration && $aDressDecoration['effect_pic'] ? Yii::getAlias('@r.url') . $aDressDecoration['effect_pic'] : 'http://placehold.it/375x234'; ?>" alt="">
			</div>
		</div>
		<div class="form-group">
			<button type="button" class="J-save-btn btn btn-primary" onclick="save(this);">保存</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	var maxPicCount = 3;
	function deletePic(o){
		$(o).parent().parent().remove();
	}
	function getDetailPics(){
		var aPics = [];
		if($('.J-detail-pics-list li').length == 0){
			UBox.show('请上传详细图片', -1);
			return false;
		}
		$('.J-detail-pics-list li').each(function(){
			aPics.push($(this).attr('data-pic'));
		});
		
		return aPics;
	}
	
	function addDetailPic(pic){
		var htmlStr = '\
			<li class="list-group-item J-pic-item" data-pic="' + pic + '">\
				<p><img class="img-thumbnail" src="' + App.url.resource + pic + '" alt=""></p>\
				<p><center><button type="button" class="btn btn-sm btn-danger" onclick="deletePic(this);">删除</button></center></p>\
			</li>\
		';
		$('.J-detail-pics-list').append(htmlStr);
	}
	
	function save(o){
		var id = $('.J-id').val();
		var name = $('.J-name').val();
		var price = $('.J-price').val();
		var aDetailPics = getDetailPics();
		var effectPic = $('.J-effect-pic').attr('data-pic');
		if(name == ''){
			UBox.show('请填写饰件名称', -1);
			return;
		}
		ajax({
			url : '<?php echo Url::to(['manager-dress-decoration/save']); ?>',
			data : {
				id : id,
				name : name,
				price : price,
				aDetailPics : aDetailPics,
				effectPic : effectPic
			},
			beforeSend : function(){
				$(o).attr('disabled', 'disabled');
			},
			complete : function(){
				$(o).attr('disabled', false);
			},
			success : function(aResult){
				if(aResult.status == 1){
					UBox.show(aResult.msg, aResult.status, function(){
						location.href = '<?php echo Url::to(['manager-dress-decoration/show-list']); ?>';
					}, 3);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	}
	
	function showDetailPics(aData){
		for(var i in aData){
			addDetailPic(aData[i]);
		}
	}
	
	$(function(){
		<?php if($aDressDecoration){ ?>
		showDetailPics(<?php echo json_encode($aDressDecoration['detail_pics']); ?>);
		<?php } ?>
		$('.J-add-detail-pics-btn').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['manager-dress-decoration/upload-file']); ?>',
			fileKey : 'image',
			isUploadEnable : function(o){
				if(parseInt($('.J-detail-pics-list li').length) >= maxPicCount){
					UBox.show('只能上传 ' + maxPicCount + ' 张图片！', -1);
					return false;
				}
				return true;
			},
			callback : function(aResult){
				if(aResult.status == 1){
					addDetailPic(aResult.data);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
		$('.J-effect-pic').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['manager-dress-decoration/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					$('.J-effect-pic').attr('data-pic', aResult.data);
					$('.J-effect-pic').attr('src', App.url.resource + aResult.data);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	});
</script>