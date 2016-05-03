<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
$this->setTitle('猜你喜欢');
?>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '猜你喜欢列表',
				'url' => Url::to(['guess-like/show-list']),
				'active' => true,
			],
			[
				'title' => '设置猜你喜欢',
				'url' => Url::to(['guess-like/show-setting']),
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">猜你喜欢列表</h1>
	</div>
</div>

<div class="row">
	<div class="table-responsive">
		<?php
			echo Table::widget([
				'aColumns'	=>	[
					'name'	=>	['title' => '服饰名称'],
					'pic'	=>	[
						'title' => '服饰图片',
						'content' => function($aData){
							return '<img width="234" height="375" class="img-thumbnail" src="' . Yii::getAlias('@r.url') . $aData['pic'] . '" alt="">';
						}
					],
					'operate' => [
						'title' => '操作',
						'class' => 'col-sm-1',
						'content' => function($aData){
							return '<a href="javascript:;" onclick="deleteItem(this, ' . $aData['dress_id'] . ');">删除</a>';
						}
					],
				],
				'aDataList'	=>	$aList,
			]);
		?>
	</div>
</div>
<script type="text/javascript">
	function deleteItem(o, dressId){
		UBox.confirm('确定要删除？', function(){
			ajax({
				url : '<?php echo Url::to(['guess-like/delete']); ?>',
				data : {
					dressId : dressId
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