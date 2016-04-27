<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('服饰分类');
?>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '服饰分类列表',
				'url' => Url::to(['dress-catalog/show-list']),
				'active' => true,
			],
			[
				'title' => '添加服饰分类',
				'url' => Url::to(['dress-catalog/show-edit']),
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">服饰分类列表</h1>
	</div>
</div>

<div class="row">
	<div class="table-responsive">
		<?php
			echo Table::widget([
				'aColumns'	=>	[
					'id'	=>	['title' => '分类ID'],
					'name'	=>	['title' => '分类名称'],
					'operate' => [
						'title' => '操作',
						'class' => 'col-sm-1',
						'content' => function($aData){
							return '<a href="' . Url::to(['dress-catalog/show-edit', 'id' => $aData['id']]) . '">编辑</a>&nbsp;&nbsp;<a href="javascript:;" onclick="deleteItem(this, ' . $aData['id'] . ');">删除</a>';
						}
					],
				],
				'aDataList'	=>	$aDressCatalogList,
			]);
		?>
	</div>
</div>
<script type="text/javascript">
	function deleteItem(o, id){
		UBox.confirm('确定要删除？', function(){
			ajax({
				url : '<?php echo Url::to(['dress-catalog/delete']); ?>',
				data : {
					id : id
				},
				beforeSend : function(){
					$(o).attr('disabled', 'disabled');
				},
				complete : function(){
					$(o).attr('disabled', false);
				},
				success : function(aResult){
					if(aResult.status == 1){
						$(o).parent().parent().remove();
					}
					UBox.show(aResult.msg, aResult.status);
				}
			});
		});
		
	}
	$(function(){
		
	});
</script>