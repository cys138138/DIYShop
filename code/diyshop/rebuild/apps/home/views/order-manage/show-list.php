<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('订单管理');
?>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '订单列表',
				'url' => Url::to(['order-manage/show-list']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">订单列表</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form role="form" class="J-search-form form-horizontal" name="J-search-form">
			<div class="J-condition-line">
				<label class="control-label" style="float:left;">订单编号</label>
				<div class="col-sm-2" style="width:130px;">
					<input type="text" class="J-order-number form-control" name="orderNumber" value="<?php echo $orderNumber ? $orderNumber : ''; ?>" />
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
					'order_number'	=>	['title' => '订单编号'],
				],
				'aDataList'	=>	$aOrderList,
			]);
			echo LinkPager::widget(['pagination' => $oPage]);
		?>
	</div>
</div>
<script type="text/javascript">
	function search(){
		var condition = $('form[name=J-search-form]').serialize();
		location.href = '<?php echo Url::to(['order-manage/show-list']); ?>?' + condition;
	}
	
	$(function(){
		
	});
</script>