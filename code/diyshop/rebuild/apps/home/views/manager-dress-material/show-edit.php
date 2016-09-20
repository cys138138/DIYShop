<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('面料管理');
?>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '面料列表',
				'url' => Url::to(['manager-dress-material/show-list']),
			],
			[
				'title' => $aDressMaterial ? '编辑面料' : '添加面料',
				'url' => Url::to(['manager-dress-material/show-edit']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $aDressMaterial ? '编辑面料' : '添加面料'; ?></h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<input class="J-id form-control" type="hidden" value="<?php echo $aDressMaterial ? $aDressMaterial['id'] : ''; ?>">
			<label>面料名称</label>
			<input class="J-name form-control" placeholder="面料名称" value="<?php echo $aDressMaterial ? $aDressMaterial['name'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<button type="button" class="J-save-btn btn btn-primary" onclick="save(this);">保存</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	function save(o){
		var id = $('.J-id').val();
		var name = $('.J-name').val();
		if(name == ''){
			UBox.show('请填写面料名称', -1);
			return;
		}
		ajax({
			url : '<?php echo Url::to(['manager-dress-material/save']); ?>',
			data : {
				id : id,
				name : name
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
						location.href = '<?php echo Url::to(['manager-dress-material/show-list']); ?>';
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