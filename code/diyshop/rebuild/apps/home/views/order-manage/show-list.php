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
	.J-express-company{
		float:left;
		width:200px;
	}
	.J-express-number{
		float:left;
		width:200px;
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
	var aKuaiDiCompanyList = <?php echo json_encode($aKuaiDiCompanyList); ?>;
	
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
					diyHtml += '<img class="J-dress-diy-pic img-thumbnail" src="' + aTemp.diy_pics[k] + '" alt="">';
				}
				diyHtml += '</p>';
			}
			if(typeof(aTemp.dress_decoration_info) != 'undefined' && aTemp.dress_decoration_info.length != 0){console.log(aTemp.dress_decoration_info);
				for(var t in aTemp.dress_decoration_info){
					diyPrice += parseInt(aTemp.dress_decoration_info[t].price);
					diyHtml += '<p><b>&nbsp;&nbsp;&nbsp;&nbsp;服饰饰件' + (parseInt(t) + 1) + '名称：</b>' + aTemp.dress_decoration_info[t].name + '</p>';
				}
			}
			if(typeof(aTemp.dress_match_info) != 'undefined' && aTemp.dress_match_info.length != 0){
				if(typeof(aTemp.dress_match_info.vender) != 'undefined' && aTemp.dress_match_info.vender.length != 0){
					for(var p in aTemp.dress_match_info.vender){
						diyPrice += parseInt(aTemp.dress_match_info.vender[p].price);
						diyHtml += '<p><b>&nbsp;&nbsp;&nbsp;&nbsp;服饰搭配' + (parseInt(p) + 1) + '名称：</b>' + aTemp.dress_match_info.vender[p].name + '</p>';
					}
				}
				if(typeof(aTemp.dress_match_info.manager) != 'undefined' && aTemp.dress_match_info.manager.length != 0){
					for(var q in aTemp.dress_match_info.manager){
						diyPrice += parseInt(aTemp.dress_match_info.manager[q].price);
						diyHtml += '<p><b>&nbsp;&nbsp;&nbsp;&nbsp;服饰搭配' + (parseInt(q) + 1) + '名称：</b>' + aTemp.dress_match_info.manager[q].name + '</p>';
					}
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
		
		htmlStr += '<div class="block-wraper">';
		htmlStr += '<h3><b>物流信息：</b></h3>';
		htmlStr += '<select class="J-express-company form-control">';
		htmlStr += '<option value="">--请选择快递公司--</option>';
		for(var key in aKuaiDiCompanyList){
			htmlStr += '<option value="' + key + '">' + aKuaiDiCompanyList[key].name + '</option>';
		}
		htmlStr += '</select>';
		htmlStr += '<input class="J-express-number form-control" placeholder="请输入物流单号" value="">';
		htmlStr += '&nbsp;&nbsp;<button type="button" class="J-save-express-btn btn btn-primary" onclick="saveExpressInfo(this, ' + aData.id + ');">保存</button>';
		htmlStr += '&nbsp;&nbsp;<button type="button" class="J-sure-send-good-btn btn btn-primary" onclick="sureSendGoods(this, ' + aData.id + ');">确认发货</button>';
		htmlStr += '</div>';
		htmlStr += '</br>';
		htmlStr += '</div>';
		
		return htmlStr;
	}
	
	function sureSendGoods(o, id){
		ajax({
			url : '<?php echo Url::to(['order-manage/sure-send-goods']); ?>',
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
				UBox.show(aResult.msg, aResult.status);
			}
		});
	}
	
	function saveExpressInfo(o, id){
		var expressType = $('.J-express-company').val();
		var expressNumber = $('.J-express-number').val();
		
		if(expressType == ''){
			UBox.show('请选择快递公司', aResult.status);
			return;
		}
		ajax({
			url : '<?php echo Url::to(['order-manage/save-express-info']); ?>',
			data : {
				id : id,
				expressType : expressType,
				expressNumber : expressNumber
			},
			beforeSend : function(){
				$(o).attr('disabled', 'disabled');
			},
			complete : function(){
				$(o).attr('disabled', false);
			},
			success : function(aResult){
				UBox.show(aResult.msg, aResult.status);
			}
		});
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
		var aOrder = getOrderInfoById(id);
		$.teninedialog({
			title : '订单信息',
			content : buildOrderBoxHtml(aOrder),
			url : '',
			showCloseButton : false,
			otherButtons : ['确定'],
			otherButtonStyles : ['btn-primary'],
			bootstrapModalOption : {keyboard: true},
			dialogShow : function(){
				//alert('即将显示对话框');
			},
			dialogShown : function(){
				if(typeof(aOrder.express_info.express_type) != 'undefined'){
					$('.J-express-company').val(aOrder.express_info.express_type);
				}
				if(typeof(aOrder.express_info.express_number) != 'undefined'){
					$('.J-express-number').val(aOrder.express_info.express_number);
				}
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