<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('服饰管理');
?>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '服饰列表',
				'url' => Url::to(['dress-manage/show-list']),
				'active' => true,
			],
			[
				'title' => '添加服饰',
				'url' => Url::to(['dress-manage/show-edit']),
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">服饰列表</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form role="form" class="J-search-form form-horizontal" name="J-search-form">
			<div class="J-condition-line">
				<label class="control-label" style="float:left;">服饰编号</label>
				<div class="col-sm-2" style="width:130px;">
					<input type="text" class="J-dress-id form-control" name="dressId" value="<?php echo $dressId ? $dressId : ''; ?>" />
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
					'id'	=>	['title' => '服饰编号'],
					'name'	=>	['title' => '服饰名称'],
					'pic'	=>	[
						'title' => '服饰图片',
						'content' => function($aData){
							return '<img width="150" height="100" src="' . Yii::getAlias('@r.url') . (isset($aData['dress_size_color_count_info'][0]['pic'][0]) ? $aData['dress_size_color_count_info'][0]['pic'][0] : '') . '" alt="" />';
						}
					],
					'price'	=>	['title' => '服饰价格'],
					'status'	=>	['title' => '服饰状态'],
					'operate' => [
						'title' => '操作',
						'class' => 'col-sm-1',
						'content' => function($aData){
							return '<a href="' . Url::to(['dress-manage/show-edit', 'id' => $aData['id']]) . '">编辑</a>&nbsp;&nbsp;<a href="javascript:;" onclick="deleteItem(this, ' . $aData['id'] . ');">删除</a>';
						}
					],
				],
				'aDataList'	=>	$aDressList,
			]);
			echo LinkPager::widget(['pagination' => $oPage]);
		?>
	</div>
</div>
<script type="text/javascript">
	function search(){
		var condition = $('form[name=J-search-form]').serialize();
		location.href = '<?php echo Url::to(['dress-manage/show-list']); ?>?' + condition;
	}
	function deleteItem(o, id){
		UBox.confirm('确定要删除？', function(){
			ajax({
				url : '<?php echo Url::to(['dress-manage/delete']); ?>',
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