<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
$this->setTitle('优惠活动');
?>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '优惠活动列表',
				'url' => Url::to(['discount-activity/show-list']),
				'active' => true,
			],
			[
				'title' => '设置优惠活动',
				'url' => Url::to(['discount-activity/show-setting']),
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">优惠活动列表</h1>
	</div>
</div>

<div class="row">
	<div class="table-responsive">
		<?php
			echo Table::widget([
				'aColumns'	=>	[
					'pic'	=>	[
						'title' => '服饰图片',
						'content' => function($aData){
							return '<img width="234" height="375" class="img-thumbnail" src="' . Yii::getAlias('@r.url') . $aData['pic'] . '" alt="">';
						}
					],
					'link_url'	=>	['title' => '链接'],
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
				url : '<?php echo Url::to(['discount-activity/delete']); ?>',
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