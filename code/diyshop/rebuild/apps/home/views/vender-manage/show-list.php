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
	<div class="col-lg-12">
		<form role="form" class="J-search-form form-horizontal" name="J-search-form">
			<div class="J-condition-line">
				<label class="control-label" style="float:left;">商家编号</label>
				<div class="col-sm-2" style="width:130px;">
					<input type="text" class="J-vender-id form-control" name="venderId" value="<?php echo $venderId ? $venderId : ''; ?>" />
				</div>
				<div class="form-group">
					<div class="col-sm-2" style="width:90px;">
						<button type="button" class="btn btn-primary" onclick="search();">搜索</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="row">
	<div class="table-responsive">
		<?php
			echo Table::widget([
				'aColumns'	=>	[
					'id'	=>	['title' => '商家编号'],
					'name'	=>	['title' => '厂商名称'],
					'user_name'	=>	['title' => '用户名'],
					/*'email'	=>	['title' => '邮箱'],
					'mobile'	=>	['title' => '手机号'],*/
					'company_code'	=>	['title' => '公司码'],
					'company_property'	=>	['title' => '公司性质'],
					'company_address' => [
						'title' => '公司地址',
						'content' => function($aData){
							return '<a title="' . $aData['company_address'] . '" target="_blank">' . mb_substr(strip_tags($aData['company_address']), 0, 10, 'utf-8') . '</a>';
						}
					],
					'monthSalesStatic' => [
						'title' => '销售情况',
						'content' => function($aData){
							$str = '';
							foreach($aData['monthSalesStatic'] as $key => $aValue){
								$str .= $key . '月总销售额:' . intval($aValue['total_price']) . '，月销量:' . intval($aValue['sales_count']) . '；';
							}
							return '<a title="' . $str . '" target="_blank">' . mb_substr(strip_tags($str), 0, 20, 'utf-8') . '</a>';
						}
					],
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
	function search(){
		var condition = $('form[name=J-search-form]').serialize();
		location.href = '<?php echo Url::to(['vender-manage/show-list']); ?>?' + condition;
	}
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