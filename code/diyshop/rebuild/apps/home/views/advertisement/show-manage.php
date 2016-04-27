<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('广告位图片');
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
		height:234px;
	}
</style>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '广告位图片',
				'url' => Url::to(['advertisement/show-manage-advertisement']),
				'active' => true,
			],
			[
				'title' => '广告位分类',
				'url' => Url::to(['advertisement/show-list']),
			],
			[
				'title' => '添加广告位分类',
				'url' => Url::to(['advertisement/show-edit']),
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">管理广告位图片</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<label>广告位分类</label>
			<select class="J-catalog form-control">
				<?php foreach($aAdvertisementCatalogConfig as $aValue){ ?>
				<option value="<?php echo $aValue['id']; ?>"><?php echo $aValue['name']; ?></option>
				<?php } ?>
			</select>
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
			<button type="button" class="J-form-upload-btn btn btn-primary">添加图片</button>
			<button type="button" class="J-form-save-btn btn btn-primary" onclick="save(this);">保存</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	var maxPicCount = <?php echo $maxPicCount; ?>;
	var aAdvertisementCatalogConfig = <?php echo json_encode($aAdvertisementCatalogConfig); ?>;
	
	function checkLimit(){
		return true;
	}
	
	function updateAdvertisementCatalogConfig(){
		var id = $('.J-catalog').val();
		for(var i in aAdvertisementCatalogConfig){
			if(aAdvertisementCatalogConfig[i].id == id){
				var aPicData = [];
				$('.J-pics-list li').each(function(){
					aPicData.push($(this).attr('data-pic'));
				});
				aAdvertisementCatalogConfig[i].pics = aPicData;
			}
		}
	}
	
	function bulidImgHtml(pic){
		var htmlStr = '\
			<li class="list-group-item" data-pic="' + pic + '">\
				<p><img class="img-thumbnail" src="' + App.url.resource + pic + '" alt=""></p>\
				<p><center><button type="button" class="btn btn-sm btn-danger" onclick="deletePic(this, \'' + pic + '\');">删除</button></center></p>\
			</li>\
		';
		return htmlStr;
	}
	
	function showPics(aPics){
		var htmlStr = '';
		for(var i in aPics){
			htmlStr += bulidImgHtml(aPics[i]);
		}
		$('.J-pics-list').html(htmlStr);
	}
	
	function save(o){
		ajax({
			url : '<?php echo Url::to(['advertisement/save-advertisement-catalog-config']); ?>',
			data : {
				aData : aAdvertisementCatalogConfig
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
	
	function deletePic(o, pic){
		$(o).parent().parent().remove();
		updateAdvertisementCatalogConfig();
	}
	
	function showPicsByCatalogId(id){
		for(var i in aAdvertisementCatalogConfig){
			if(aAdvertisementCatalogConfig[i].id == id){
				showPics(aAdvertisementCatalogConfig[i].pics);
			}
		}
	}
	
	$(function(){
		$('.J-catalog').on('change', function(){
			showPicsByCatalogId($(this).val());
		});
		
		$('.J-form-upload-btn').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['advertisement/upload-file']); ?>',
			fileKey : 'image',
			isUploadEnable : function(){
				if(parseInt($('.J-pics-list li').length) >= maxPicCount){
					UBox.show('只能上传 ' + maxPicCount + ' 张图片！', -1);
					return false;
				}
				return true;
			},
			callback : function(aResult){
				if(aResult.status == 1){
					$('.J-pics-list').append(bulidImgHtml(aResult.data));
					updateAdvertisementCatalogConfig();
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
		showPicsByCatalogId($('.J-catalog').val());
	});
</script>