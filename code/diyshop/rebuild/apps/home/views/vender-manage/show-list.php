<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('商家管理');
?>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '商家列表',
				'url' => Url::to(['vender-manage/show-list']),
				'active' => true,
			],
			[
				'title' => '添加商家',
				'url' => Url::to(['vender-manage/show-edit']),
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">商家列表</h1>
	</div>
</div>

<div class="row">
	<div class="table-responsive">
		<?php
			echo Table::widget([
				'aColumns'	=>	[
					'id'	=>	['title' => '商家ID'],
					'name'	=>	['title' => '厂商名称'],
					'user_name'	=>	['title' => '用户名'],
					'email'	=>	['title' => '邮箱'],
					'mobile'	=>	['title' => '手机号'],
					'company_code'	=>	['title' => '公司码'],
					'operate' => [
						'title' => '操作',
						'class' => 'col-sm-1',
						'content' => function($aData){
							return '<a href="' . Url::to(['vender-manage/show-edit', 'id' => $aData['id']]) . '">编辑</a>&nbsp;&nbsp;<a href="javascript:;" onclick="deleteItem(this, ' . $aData['id'] . ');">删除</a>';
						}
					],
				],
				'aDataList'	=>	$aVenderList,
			]);
			echo LinkPager::widget(['pagination' => $oPage]);
		?>
	</div>
</div>
<script type="text/javascript">
	function deleteItem(o, id){
		UBox.confirm('确定要删除？', function(){
			ajax({
				url : '<?php echo Url::to(['vender-manage/delete']); ?>',
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