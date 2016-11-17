<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
use common\model\ReturnExchange;
$this->setTitle('退换货管理');
?>
<style type="text/css">
	.modal-dialog{
		width:1000px;
	}
	
	.J-order-win{
		width:970px;
		height:500px;
		max-height:500px;
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
	.J-re-pic{
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
			],
			[
				'title' => '退换货列表',
				'url' => Url::to(['order-manage/show-return-exchange-list']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">退换货列表</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form role="form" class="J-search-form form-horizontal" name="J-search-form">
			<div class="J-condition-line">
				<label class="control-label" style="float:left;">用户ID</label>
				<div class="col-sm-2" style="width:130px;">
					<input type="text" class="J-user-id form-control" name="userId" value="<?php echo $userId ? $userId : ''; ?>" />
				</div>
				<label class="control-label" style="float:left;">订单编号</label>
				<div class="col-sm-2" style="width:200px;">
					<input type="text" class="J-order-number form-control" name="orderNumber" value="<?php echo $orderNumber ? $orderNumber : ''; ?>" />
				</div>
				<label class="control-label" style="float:left;">类型</label>
				<div class="col-sm-2" style="width:150px;">
					<select class="J-type form-control" name="type">
						<option value="0">全部</option>
						<option value="1">退货退款</option>
						<option value="2">仅退款</option>
						<option value="3">仅换货</option>
					</select>
				</div>
				<label class="control-label" style="float:left;">状态</label>
				<div class="col-sm-2" style="width:130px;">
					<select class="J-is-handle form-control" name="isHandle">
						<option value="0">未处理</option>
						<option value="1">已处理</option>
					</select>
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
					'user_name'	=>	[
						'title' => '用户名',
						'content' => function($aData){
							return $aData['user_info']['name'];
						}
					],
					'user_mobile'	=>	[
						'title' => '用户手机',
						'content' => function($aData){
							return $aData['user_info']['mobile'];
						}
					],
					'create_time'	=>	[
						'title' => '申请时间',
						'content' => function($aData){
							return date('Y-m-d H:i:s', $aData['create_time']);
						}
					],
					'operation'	=>	[
						'title' => '操作',
						'class' => 'col-sm-1',
						'content' => function($aData){
							return '<a href="javascript:;" onclick="showReturnExchangeOrder(\'' . $aData['order_number'] . '\');">查看</a>';
						}
					],
				],
				'aDataList'	=>	$aReturnExchangeList,
			]);
			echo LinkPager::widget(['pagination' => $oPage]);
		?>
	</div>
</div>
<script type="text/javascript">
	var aReturnExchangeList = <?php echo json_encode($aReturnExchangeList); ?>;
	
	function search(){
		var condition = $('form[name=J-search-form]').serialize();
		location.href = '<?php echo Url::to(['order-manage/show-return-exchange-list']); ?>?' + condition;
	}
	
	function buildOrderBoxHtml(aReturnExchange){
		var aBtnStr = {
			<?php echo ReturnExchange::TYPE_RETURN_AND_EXCHANGE; ?> : ['退货退款成功', '退货退款关闭'],
			<?php echo ReturnExchange::TYPE_RETURN_MONEY; ?> : ['退款成功', '退款关闭'],
			<?php echo ReturnExchange::TYPE_RETURN_GOODS; ?> : ['退货成功', '退货关闭'],
		};
		var aData = aReturnExchange.order_info;
		var htmlStr = '';
		
		htmlStr += '<div class="J-order-win">';
		htmlStr += '<div class="block-wraper">';
		var typeStr = '';
		if(aReturnExchange.type == <?php echo ReturnExchange::TYPE_RETURN_AND_EXCHANGE; ?>){
			typeStr = '退货退款';
		}else if(aReturnExchange.type == <?php echo ReturnExchange::TYPE_RETURN_MONEY; ?>){
			typeStr = '仅退款';
		}else if(aReturnExchange.type == <?php echo ReturnExchange::TYPE_RETURN_GOODS; ?>){
			typeStr = '仅换货';
		}
		var picHtml = '';
		if(aReturnExchange.pics.length != 0){
			for(var jj in aReturnExchange.pics){
				picHtml += '<img class="J-re-pic img-thumbnail" src="' + App.url.qiniu + aReturnExchange.pics[jj] + '" alt="">';
			}
		}
		htmlStr += '<p><b>&nbsp;&nbsp;&nbsp;&nbsp;退换货类型：</b>' + typeStr + '</p>';
		htmlStr += '<p><b>&nbsp;&nbsp;&nbsp;&nbsp;退换货原因：</b>' + aReturnExchange.reason + '</p>';
		htmlStr += '<p><b>&nbsp;&nbsp;&nbsp;&nbsp;退换货描述：</b>' + aReturnExchange.desc + '</p>';
		htmlStr += '<p><b>&nbsp;&nbsp;&nbsp;&nbsp;退换货时间：</b>' + JsTools.date('Y-m-d H:i:s', aReturnExchange.create_time) + '</p>';
		if(picHtml != ''){
			htmlStr += '<p><b>&nbsp;&nbsp;&nbsp;&nbsp;退换货图片</b></p>';
			htmlStr += '<p style="height:200px;">' + picHtml + '</p>';
		}
		if(aReturnExchange.is_handle != 1){
			htmlStr += '&nbsp;&nbsp;<button type="button" class=" btn btn-primary" onclick="sureRetuenExchange(this, ' + aReturnExchange.id + ', 1);">' + aBtnStr[aReturnExchange.type][0]+ '</button>';
			htmlStr += '&nbsp;&nbsp;<button type="button" class=" btn btn-primary" onclick="sureRetuenExchange(this, ' + aReturnExchange.id + ', 0);">' + aBtnStr[aReturnExchange.type][1]+ '</button>';
		}
		htmlStr += '</div>';
		htmlStr += '<hr />';
		htmlStr += '<div class="block-wraper"><h3><b>订单信息</b></h3></div>';
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
			if(typeof(aTemp.dress_decoration_info) != 'undefined' && aTemp.dress_decoration_info.length != 0){
				for(var t in aTemp.dress_decoration_info){
					var cc = 0;
					for(var kk in aTemp.decoration_ids){
						if(aTemp.decoration_ids[kk].id == aTemp.dress_decoration_info[t].id){
							cc = aTemp.decoration_ids[kk].count;
							break;
						}
					}
					diyPrice += parseFloat(aTemp.dress_decoration_info[t].price) * cc;
					diyHtml += '<p><b>&nbsp;&nbsp;&nbsp;&nbsp;服饰饰件' + (parseInt(t) + 1) + '名称：</b>' + aTemp.dress_decoration_info[t].name + '&nbsp;&nbsp;×&nbsp;' + cc + '件</p>';
				}
			}
			if(typeof(aTemp.dress_match_info) != 'undefined' && aTemp.dress_match_info.length != 0){
				if(typeof(aTemp.dress_match_info.vender) != 'undefined' && aTemp.dress_match_info.vender.length != 0){
					for(var p in aTemp.dress_match_info.vender){
						diyPrice += parseFloat(aTemp.dress_match_info.vender[p].price);
						diyHtml += '<p><b>&nbsp;&nbsp;&nbsp;&nbsp;服饰搭配' + (parseInt(p) + 1) + '名称：</b>' + aTemp.dress_match_info.vender[p].name + '</p>';
					}
				}
				if(typeof(aTemp.dress_match_info.manager) != 'undefined' && aTemp.dress_match_info.manager.length != 0){
					for(var q in aTemp.dress_match_info.manager){
						diyPrice += parseFloat(aTemp.dress_match_info.manager[q].price);
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
		
		/*htmlStr += '<div class="block-wraper">';
		htmlStr += '<h3><b>物流信息：</b></h3>';
		htmlStr += '<select class="J-express-company form-control">';
		htmlStr += '<option value="">--请选择快递公司--</option>';
		for(var key in aKuaiDiCompanyList){
			htmlStr += '<option value="' + key + '">' + aKuaiDiCompanyList[key].name + '</option>';
		}
		htmlStr += '</select>';
		htmlStr += '<input class="J-express-number form-control" placeholder="请输入物流单号" value="">';
		htmlStr += '&nbsp;&nbsp;<button type="button" class="J-save-express-btn btn btn-primary" onclick="saveExpressInfo(this, ' + aData.id + ');">保存</button>';
		htmlStr += '&nbsp;&nbsp;<button type="button" class="J-sure-send-good-btn btn btn-primary" onclick="sureSendGoods(this, ' + aData.id + ');">确认发货</button>';*/
		//htmlStr += '</div>';
		htmlStr += '</br>';
		htmlStr += '</div>';
		
		return htmlStr;
	}
	
	function sureRetuenExchange(o, id, status){
		UBox.confirm('确定操作？操作前请确保已处理完成', function(){
			ajax({
				url : '<?php echo Url::to(['order-manage/sure-return-exchange']); ?>',
				data : {
					id : id,
					status : status
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
		});
	}
	
	function getReturnExchangeInfoById(id){
		var aOrderInfo = {};
		for(var i in aReturnExchangeList){
			if(aReturnExchangeList[i].order_number == id){
				aOrderInfo = aReturnExchangeList[i];
				break;
			}
		}
		return aOrderInfo;
	}
	
	function showReturnExchangeOrder(id){
		var aReturnExchange = getReturnExchangeInfoById(id);
		$.teninedialog({
			title : '退换货信息',
			content : buildOrderBoxHtml(aReturnExchange),
			url : '',
			showCloseButton : false,
			otherButtons : ['确定'],
			otherButtonStyles : ['btn-primary'],
			bootstrapModalOption : {keyboard: true},
			dialogShow : function(){
				//alert('即将显示对话框');
			},
			dialogShown : function(){
				/*if(typeof(aReturnExchange.order_info.express_info.express_type) != 'undefined'){
					$('.J-express-company').val(aReturnExchange.order_info.express_info.express_type);
				}
				if(typeof(aReturnExchange.order_info.express_info.express_number) != 'undefined'){
					$('.J-express-number').val(aReturnExchange.order_info.express_info.express_number);
				}*/
				$('.J-order-win').parent().css({"max-height":"500px"});
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
		$('.J-type').val(<?php echo $type; ?>);
		$('.J-is-handle').val(<?php echo $isHandle; ?>);
	});
</script>