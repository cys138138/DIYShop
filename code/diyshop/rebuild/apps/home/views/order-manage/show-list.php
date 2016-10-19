<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('订单管理');
?>
<style type="text/css">
	.modal-dialog{
		width:1000px;
	}
	.J-order-win{
		width:970px;
		height:500px;
		max-height:600px;
	}
	.block-wraper{
		width:970px;
	}
	.J-dress-detail-pic{
		float:left;
		width:200px;
		height:200px;
	}
	.J-dress-diy-pic{
		float:left;
		width:200px;
		height:200px;
	}
</style>
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
					'operation'	=>	[
						'title' => '操作',
						'class' => 'col-sm-1',
						'content' => function($aData){
							return '<a href="javascript:;" onclick="showOrder(' . $aData['id'] . ');">查看</a>';
						}
					],
				],
				'aDataList'	=>	$aOrderList,
			]);
			echo LinkPager::widget(['pagination' => $oPage]);
		?>
	</div>
</div>
<script type="text/javascript">
	var aOrderList = <?php echo json_encode($aOrderList); ?>;
	
	function search(){
		var condition = $('form[name=J-search-form]').serialize();
		location.href = '<?php echo Url::to(['order-manage/show-list']); ?>?' + condition;
	}
	
	function buildOrderBoxHtml(aData){
		var htmlStr = '';
		
		htmlStr += '<div class="J-order-win">';
		for(var i in aData.order_info){
			var aTemp = aData.order_info[i];
			htmlStr += '\
				<div class="block-wraper">\
					<h3><b>买家信息：</b></h3>\
					<p><b>&nbsp;&nbsp;&nbsp;&nbsp;收货地址：</b>' + aTemp.delivery_address_info.address + '</p>\
					<p><b>&nbsp;&nbsp;&nbsp;&nbsp;联系电话：</b>' + aTemp.delivery_address_info.contact + '</p>\
					<p><b>&nbsp;&nbsp;&nbsp;&nbsp;收货人：</b>' + aTemp.delivery_address_info.name + '</p>\
					<p><b>&nbsp;&nbsp;&nbsp;&nbsp;买家留言：</b>' + aTemp.buyer_msg + '</p>\
				</div>\
			';
			
			var detailPicHtml = '';
			if(aTemp.item_size_color_count_info.pic.length != 0){
				for(var j in aTemp.item_size_color_count_info.pic){
					detailPicHtml += '<img class="J-dress-detail-pic img-thumbnail" src="' + App.url.resource + aTemp.item_size_color_count_info.pic[j] + '" alt="">';
				}
			}
			var diyPrice = 0;
			var diyHtml = '';
			if(typeof(aTemp.diy_pics) != 'undefined' && aTemp.diy_pics.length != 0){
				diyHtml += '<p><b>&nbsp;&nbsp;&nbsp;&nbsp;服饰设计后正反面图片</b></p>';
				diyHtml += '<p style="height:200px;">';
				for(var k in aTemp.diy_pics){
					diyHtml += '<img class="J-dress-diy-pic img-thumbnail" src="' + App.url.resource + aTemp.diy_pics[k] + '" alt="">';
				}
				diyHtml += '</p>';
			}
			if(typeof(aTemp.dress_decoration_info) != 'undefined' && aTemp.dress_decoration_info.length != 0){
				for(var t in aTemp.dress_decoration_info){
					diyPrice += aTemp.dress_decoration_info[t].price;
					diyHtml += '<p><b>&nbsp;&nbsp;&nbsp;&nbsp;服饰饰件' + (t + 1) + '名称：</b>' + aTemp.dress_decoration_info[t].name + '</p>';
				}
			}
			if(typeof(aTemp.dress_match_info) != 'undefined' && aTemp.dress_match_info.length != 0){
				for(var p in aTemp.dress_match_info){
					diyPrice += aTemp.dress_match_info[p].price;
					diyHtml += '<p><b>&nbsp;&nbsp;&nbsp;&nbsp;服饰搭配' + (p + 1) + '名称：</b>' + aTemp.dress_decoration_info[p].name + '</p>';
				}
			}
			htmlStr += '\
				<div class="block-wraper">\
					<h3><b>服饰信息：</b></h3>\
					<p><b>&nbsp;&nbsp;&nbsp;&nbsp;服饰名称：</b>' + aTemp.item_info.name + '</p>\
					<p><b>&nbsp;&nbsp;&nbsp;&nbsp;服饰尺码：</b>' + aTemp.item_size_color_count_info.size_name + '</p>\
					<p><b>&nbsp;&nbsp;&nbsp;&nbsp;服饰颜色：</b>' + aTemp.item_size_color_count_info.color_name + '</p>\
					<p><b>&nbsp;&nbsp;&nbsp;&nbsp;服饰数量：</b>' + aTemp.item_count + '</p>\
					<p><b>&nbsp;&nbsp;&nbsp;&nbsp;服饰详细图片</b></p>\
					<p style="height:200px;">' + detailPicHtml + '</p>\
					<p><b>&nbsp;&nbsp;&nbsp;&nbsp;服饰费用：</b>' + aTemp.item_price + '</p>\
					<p><b>&nbsp;&nbsp;&nbsp;&nbsp;diy费用：</b>' + diyPrice + '</p>\
					' + diyHtml + '\
				</div>\
			';

			htmlStr += '<hr />';
		}
		htmlStr += '</div>';
		
		return htmlStr;
	}
	
	function getOrderInfoById(id){
		var aOrderInfo = {};
		for(var i in aOrderList){
			if(aOrderList[i].id == id){
				aOrderInfo = aOrderList[i];
				break;
			}
		}
		return aOrderInfo;
	}
	
	function showOrder(id){
		$.teninedialog({
			title : '订单信息',
			content : buildOrderBoxHtml(getOrderInfoById(id)),
			url : '',
			showCloseButton : false,
			otherButtons : ['确定'],
			otherButtonStyles : ['btn-primary'],
			bootstrapModalOption : {keyboard: true},
			dialogShow : function(){
				//alert('即将显示对话框');
			},
			dialogShown : function(){
				
			},
			dialogHide : function(){
				//alert('即将关闭对话框');
			},
			dialogHidden : function(){
				//alert('关闭对话框');
			},
			clickButton : function(sender, modal, index){
				$(this).closeDialog(modal);
			}
		});
	}
	
	$(function(){
		
	});
</script>