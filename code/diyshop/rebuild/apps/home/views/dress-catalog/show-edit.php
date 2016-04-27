<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('服饰分类');
$this->registerAssetBundle('common\assets\AjaxUploadAsset');
?>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '服饰分类列表',
				'url' => Url::to(['dress-catalog/show-list']),
			],
			[
				'title' => $aDressCatalog ? '编辑服饰分类' : '添加服饰分类',
				'url' => Url::to(['dress-catalog/show-edit']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $aDressCatalog ? '编辑服饰分类' : '添加服饰分类'; ?></h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<input class="J-id form-control" type="hidden" value="<?php echo $aDressCatalog ? $aDressCatalog['id'] : ''; ?>">
			<label>分类名称</label>
			<input class="J-name form-control" placeholder="分类名称" value="<?php echo $aDressCatalog ? $aDressCatalog['name'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<label>是否显示</label>
			<label class="radio-inline">
				<input type="radio" name="isShow" class="J-is-show" value="1" checked="">是
			</label>
			<label class="radio-inline">
				<input type="radio" name="isShow" class="J-is-show" value="0">否
			</label>
		</div>
		<br />
		<div class="form-group">
			<button type="button" class="J-save-btn btn btn-primary" onclick="save(this);">保存</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	function save(o){
		var id = $('.J-id').val();
		var name = $('.J-name').val();
		var isShow = $('.J-is-show:checked').val();
		if(name == ''){
			UBox.show('请填写分类名称', -1);
			return;
		}
		ajax({
			url : '<?php echo Url::to(['dress-catalog/save']); ?>',
			data : {
				id : id,
				name : name,
				isShow : isShow
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
						location.href = '<?php echo Url::to(['dress-catalog/show-list']); ?>';
					}, 3);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	}
	$(function(){
		
	});
</script>