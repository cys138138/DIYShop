<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
use common\model\DressCatalog;
$this->setTitle('服饰分类');
?>
<style type="text/css">
	#page-wrapper{padding:0 10px;/*font-family:'Microsoft Yahei';*/}
	#page-wrapper .col-sm-2{width:16%;}
	#page-wrapper .control-label{width:90px;}
	.table-responsive, .modal-dialog{/*font-family:'Microsoft Yahei';*/}
	table tr a{text-decoration:none;}
	
	.J-modify-win-line{height:35px;line-height:35px; text-align:center;}
	.J-modify-win-line span{float:left;display:block;width:100px;font-size:16px;font-weight:blod;}
	.J-modify-win-line select{float:left;width:150px;}
	.J-modify-win-line label{float:left;line-height:35px;}
	
	.J-hover-box{position:absolute;top:0px;left:0px;border:2px solid #00ff00;background:#E7E7E7;color:#000000;padding:10px;}
	
	.J-row{height:80px; line-height:50px;}
	.table-responsive .J-row td{height:50px; line-height:50px; font-size:16px;}
	
	.J-classify-list .tr-child{background:#DBE4E7;border-radius:20px;}
	.table-responsive .J-classify-list table{width:90%;}
	.table-responsive .J-classify-list table tr{height:35px;}
	.table-responsive .J-classify-list table tr td, .table-responsive .J-classify-list table tr th{height:35px;line-height:35px; font-size:14px;}
	
	.J-angle{
		position:relative;
		left:0px;
		top:-28px;
		height:20px;
		width:20px;
		border-left: 20px solid transparent;
		border-right: 20px solid transparent;
		border-bottom: 20px solid #DBE4E7;
	}
</style>
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
					'is_show'	=>	[
						'title' => '是否显示',
						'content' => function($aData){
							if($aData['is_show'] == DressCatalog::IS_SHOW){
								return '是';
							}else{
								return '否';
							}
						}
					],
					'operate' => [
						'title' => '操作',
						'class' => 'col-sm-2',
						'content' => function($aData){
							$childBtn = '';
							if($aData['child']){
								$childBtn = '<a href="javascript:;" data-status="0" onclick="showChild(this, ' . $aData['id'] . ');">查看子分类</a>';
							}
							return '<a href="' . Url::to(['dress-catalog/show-edit', 'id' => $aData['id']]) . '">编辑</a>&nbsp;&nbsp;<a href="javascript:;" onclick="deleteItem(this, ' . $aData['id'] . ');">删除</a>&nbsp;&nbsp;' . $childBtn;
						}
					],
				],
				'aDataList'	=>	$aDressCatalogList,
			]);
		?>
	</div>
</div>
<script type="text/javascript">
	var aDressCatalogList = <?php echo json_encode($aDressCatalogList); ?>;
	var editUrl = '<?php echo Url::to(['dress-catalog/show-edit', 'id' => '__id__']); ?>';
	
	function buildChildHtml(categoryId, aList){
		var htmlStr = '<tr class="J-row J-classify-list"><td class="tr-child" colspan="4"><center><div class="J-angle"></div><table><tr style="border-bottom:1px solid #C5B5B5;"><th>分类ID</th><th>分类名称</th><th>是否显示</th><th>操作</th></tr>';
		for(var i in aList){
			var aTemp = aList[i];
			var url = editUrl.replace('__id__', aTemp.id);
			htmlStr += '<tr><td>' + aTemp.id + '</td><td>' + aTemp.name + '</td><td>' + (aTemp.is_show == <?php echo DressCatalog::IS_SHOW; ?> ? '是' : '否') + '</td><td><a href="' + url + '">编辑</a>&nbsp;&nbsp;<a href="javascript:;" onclick="deleteItem(this, ' + aTemp.id + ');">删除</a></td></tr>';
		}
		if(aList.length == 0){
			htmlStr += '<tr><td colspan="6" style="text-align:center;">暂无子分类</td></tr>';
		}
		htmlStr += '</table></center></td></tr>';
		return htmlStr;
	}
	
	function showChild(oDom, id){
		var status = $(oDom).attr('data-status');
		if(status == 1){
			$(oDom).parent().parent().next().remove();
			$(oDom).attr('data-status', 0);
			$(oDom).text('查看子分类');
			$(oDom).css({color : '#337ab7'});
			return;
		}
		var aList = getChildListById(id);
		$(oDom).parent().parent().after(buildChildHtml(id, aList));
		$(oDom).attr('data-status', 1);
		$(oDom).text('关闭子分类');
		$(oDom).css({color : '#0000ff'});
	}
	
	function getChildListById(id){
		var aList = [];
		for(var i in aDressCatalogList){
			var aTemp = aDressCatalogList[i];
			if(aTemp.id == id){
				aList = aTemp.child;
				break;
			}
		}
		return aList;
	}
	
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