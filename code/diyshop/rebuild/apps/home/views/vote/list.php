<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
$this->setTitle('投票');
?>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '投票列表',
				'url' => Url::to(['vote/show-list']),
				'active' => true,
			],
			[
				'title' => '添加投票',
				'url' => Url::to(['vote/show-setting']),
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">投票列表</h1>
	</div>
</div>

<div class="row">
	<div class="table-responsive">
		<?php
			echo Table::widget([
				'aColumns'	=>	[
					'pic'	=>	[
						'title' => '投票图片',
						'content' => function($aData){
							return '<img width="234" height="375" class="img-thumbnail" src="' . Yii::getAlias('@r.url') . $aData['pic'] . '" alt="">';
						}
					],
					'description'	=>	['title' => '投票说明'],
					'operate' => [
						'title' => '操作',
						'class' => 'col-sm-1',
						'content' => function($aData){
							return '<a href="javascript:;" onclick="deleteItem(this, \'' . $aData['pic'] . '\');">删除</a>';
						}
					],
				],
				'aDataList'	=>	$aList,
			]);
		?>
	</div>
</div>
<script type="text/javascript">
	function deleteItem(o, id){
		UBox.confirm('确定要删除？', function(){
			ajax({
				url : '<?php echo Url::to(['vote/delete']); ?>',
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