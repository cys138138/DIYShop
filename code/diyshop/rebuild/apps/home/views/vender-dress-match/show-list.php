<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('搭配管理');
?>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '搭配列表',
				'url' => Url::to(['vender-dress-match/show-list']),
				'active' => true,
			],
			[
				'title' => '添加搭配',
				'url' => Url::to(['vender-dress-match/show-edit']),
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">搭配列表</h1>
	</div>
</div>

<div class="row">
	<div class="table-responsive">
		<?php
			echo Table::widget([
				'aColumns'	=>	[
					'id'	=>	['title' => '搭配编号'],
					'name'	=>	['title' => '搭配别名'],
					'catalog_path'	=>	['title' => '服饰分类'],
					'sex_str'	=>	['title' => '性别'],
					'operation'	=>	[
						'title' => '操作',
						'class' => 'col-sm-1',
						'content' => function($aData){
							return '<a href="' . Url::to(['vender-dress-match/show-edit', 'id' => $aData['id']]) . '">编辑</a>&nbsp;&nbsp;<a href="javascript:;" onclick="deleteItem(this, ' . $aData['id'] . ');">删除</a>';
						}
					],
				],
				'aDataList'	=>	$aList,
			]);
			echo LinkPager::widget(['pagination' => $oPage]);
		?>
	</div>
</div>
<script type="text/javascript">
	function deleteItem(o, id){
		UBox.confirm('确定要删除？', function(){
			ajax({
				url : '<?php echo Url::to(['vender-dress-match/delete']); ?>',
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