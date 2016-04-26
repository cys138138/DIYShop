<?php 
use umeworld\lib\Url;
$this->setTitle('广告位管理');
$this->registerAssetBundle('common\assets\AjaxUploadAsset');
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">广告位管理</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<label>广告位分类</label>
			<select class="form-control">
				<?php foreach($aAdvertisementCatalogConfig as $aValue){ ?>
				<option value="<?php echo $aValue['id']; ?>"><?php echo $aValue['name']; ?></option>
				<?php } ?>
			</select>
		</div>
		<br />
		<div class="form-group">
			<button type="button" class="J-form-upload-btn btn btn-default">添加图片</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('.J-form-upload-btn').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['advertisement/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
				
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	});
</script>