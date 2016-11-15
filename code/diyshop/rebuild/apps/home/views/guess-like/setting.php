<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
$this->setTitle('猜你喜欢');
?>
<style type="text/css">
	.list-group-item{
		width:375px;
		height:298px;
		float:left;
		margin:10px;
	}
	.list-group-item img{
		width:375px;
		height:234px;
	}
	.li-select{
		background-color: #ccc;
	}
</style>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '猜你喜欢列表',
				'url' => Url::to(['guess-like/show-list']),
			],
			[
				'title' => '设置猜你喜欢',
				'url' => Url::to(['guess-like/show-setting']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">设置猜你喜欢</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<form role="form" class="J-search-form form-horizontal" name="J-search-form">
			<div class="J-condition-line">
				<label class="control-label" style="float:left;">商家编号</label>
				<div class="col-sm-2" style="width:160px;">
					<input type="text" class="J-vender-id form-control" name="venderId" placeholder="请输入商家编号" value="" />
				</div>
				<label class="control-label" style="float:left;">服饰编号</label>
				<div class="col-sm-2" style="width:160px;">
					<input type="text" class="J-dress-id form-control" name="dressId" placeholder="请输入服饰编号" value="" />
				</div>
				<div class="form-group">
					<div class="col-sm-2" style="width:90px;">
						<button type="button" class="btn btn-primary" onclick="search(this);">查找</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="row">
	<div class="J-result col-lg-12"></div>
</div>
<br />
<br />
<div class="J-save-setting row" style="display:none;">
	<div class="col-lg-12">
		<div class="form-group">
			<button type="button" class="J-save-btn btn btn-primary" onclick="save(this);">保存设置</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	var hasPic = false;
	var aDress = [];
	function showResult(aData){
		if(!aData){
			$('.J-save-setting').hide();
			return;
		}
		var picHtml = '';
		var hasPic = false;
		for(var i in aData.pics){
			if(aData.pics[i] != ''){
				hasPic = true;
			}
			picHtml += '<li class="list-group-item" data-index="' + i + '">\
				<p><img class="img-thumbnail" src="' + App.url.resource + aData.pics[i] + '" alt=""></p>\
				<p><center><button type="button" class="btn btn-sm btn-danger" onclick="selectPic(this);">选择</button></center></p>\
			</li>';
		}
		var htmlStr = '<h3>查找结果</h3>\
			<br />\
			<label class="control-label">服饰名称:' + aData.name + '</label>\
			<ul class="J-pics-list list-group">' + picHtml  + '</ul>\
			<br />\
		';
		$('.J-result').html(htmlStr);
		$('.J-save-setting').show();
		/*if(hasPic){
			$('.J-save-setting').show();
		}else{
			$('.J-save-setting').hide();
		}*/
	}
	
	function selectPic(o){
		$('.J-pics-list li').removeClass('li-select');
		$(o).parent().parent().addClass('li-select');
	}

	function search(o){
		var venderId = $('.J-vender-id').val();
		var dressId = $('.J-dress-id').val();
		if(venderId == ''){
			UBox.show('请输入商家编号', -1);
			return;
		}
		if(dressId == ''){
			UBox.show('请输入服饰编号', -1);
			return;
		}
		ajax({
			url : '<?php echo Url::to(['guess-like/search-dress']); ?>',
			data : {
				venderId : venderId,
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
					aDress = aResult.data
					showResult(aResult.data);
				}else{
					$('.J-save-setting').hide();
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	}
	
	function save(o){
		if(!hasPic){
			UBox.show('该服饰没有图片', -1);
			return;
		}
		if($('.li-select').length == 0){
			UBox.show('请选择图片', -1);
			return;
		}
		
		var picIndex = $('.li-select').attr('data-index');

		ajax({
			url : '<?php echo Url::to(['guess-like/save-setting']); ?>',
			data : {
				picIndex : picIndex,
				dressId : aDress.id
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
	
	$(function(){
		
	});
</script>