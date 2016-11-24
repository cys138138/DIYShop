<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
$this->setTitle('投票');
$this->registerAssetBundle('common\assets\AjaxUploadAsset');
$this->registerAssetBundle('common\assets\WdatePickerAsset');
?>
<style type="text/css">
	.J-pic-wraper{
		width:375px;
		height:264px;
		display:none;
	}
	.J-pic-wraper img{
		width:375px;
		height:234px;
	}
	#wrapper .J-line-input{
		width: 130px;
		float:left;
		margin-right: 10px;
	} 
	#wrapper .list-group-item{
		height:34px;
		float:left;
		line-height: 16px;
		margin:2px;
	}
	#wrapper .list-group-item a{
		display:block;
		float:left;
		text-decoration:none;
	}
	#wrapper .list-group-item i{
		float:left;
		display:block;
		cursor:pointer;
	}
	.J-select-size-list li{
		cursor:pointer;
	}
	#wrapper .J-pic-item{
		width:375px;
		height:298px;
		float:left;
		margin:2px;
	}
	#wrapper .J-pic-item img{
		width:375px;
		height:234px;
	}
</style>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '投票列表',
				'url' => Url::to(['vote/show-list']),
			],
			[
				'title' => '添加投票',
				'url' => Url::to(['vote/show-setting']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">添加投票</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<label>投票服饰ID</label>
			<input class="J-dress-id form-control" placeholder="请输入投票服饰ID" value="">
			<br />
		</div>
		<div class="form-group">
			<label>投票名称</label>
			<input class="J-name form-control" placeholder="请输入投票名称" value="">
			<br />
		</div>
		<div class="form-group">
			<label>投票说明</label>
			<textarea class="J-description form-control" rows="3" placeholder="请输入投票说明"></textarea>
			<br />
		</div>
		<div class="form-group">
			<label>上架货号</label>
			<input class="J-on-sales-number form-control" placeholder="请输入上架货号" value="">
			<br />
		</div>
		<div class="form-group">
			<label>主要材质</label>
			<input class="J-material form-control" placeholder="请输入主要材质" value="">
			<br />
		</div>
		<div class="form-group" style="margin-top:15px;">
			<label>尺码</label>
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-select-size-list list-group">
					<?php foreach($aSizeList as $key => $value){ ?>
						<li class="list-group-item" onclick="addSize(this, 1);"><p><a><?php echo $value; ?></a></p></li>
					<?php } ?>
					</ul>
				</div>
				<br />
			</div>
			<br />
			<div class="form-group">
				<input class="J-line-input J-size form-control" placeholder="请输入尺码" value="">
				<button type="button" class="J-line-input btn btn-info" onclick="addSize(this);" style="width:55px;">添加</button>
				<br />
			</div>
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-size-list list-group"></ul>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>上架日期</label>
			<input class="J-on-sales-day form-control" placeholder="请输入上架日期" value="" onclick="WdatePicker({dateFmt:'yyyy-M-d'});">
			<br />
		</div>
		<div class="form-group">
			<button type="button" class="J-form-upload-btn btn btn-primary">上传投票图片</button>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-pic-list list-group"></ul>
				</div>
			</div>
			<br />
		</div>
		<br />
		<div class="form-group">
			<button type="button" class="J-save-btn btn btn-primary" onclick="save(this);">保存</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	var currentPic = '';
	
	function addSize(o, type){
		var size = $('.J-size').val();
		if(type){
			size = $(o).find('a').text();
		}
		if(size == ''){
			UBox.show('尺码不能为空', -1);
			return;
		}
		$('.J-size-list').append(buildSizeHtml(size));
		$('.J-size').val('');
	}
	
	function deleteSize(o){
		$(o).parent().parent().remove();
	}
	
	function getSize(){
		var aSize = [];
		if($('.J-size-list li').length == 0){
			UBox.show('请添加尺码', -1);
			return false;
		}
		$('.J-size-list li').each(function(){
			aSize.push($(this).find('a').text());
		});
		
		return aSize;
	}
	
	function buildSizeHtml(tag){
		return '<li class="list-group-item"><p><a>' + tag + '</a><i onclick="deleteSize(this);">&nbsp;&nbsp;×</i></p></li>';
	}
	
	function save(o){
		var dressId = $('.J-dress-id').val();
		if(dressId == ''){
			UBox.show('请输入投票服饰ID', -1);
			return;
		}
		var name = $('.J-name').val();
		if(name == ''){
			UBox.show('请输入投票名称', -1);
			return;
		}
		var description = $('.J-description').val();
		if(description == ''){
			UBox.show('请输入投票说明', -1);
			return;
		}
		var onSalesNumber = $('.J-on-sales-number').val();
		if(onSalesNumber == ''){
			UBox.show('请输入上架货号', -1);
			return;
		}
		var material = $('.J-material').val();
		if(material == ''){
			UBox.show('请输入主要材质', -1);
			return;
		}
		var aSize = getSize();
		if(!aSize){
			UBox.show('请输入尺码', -1);
			return;
		}
		var onSalesDay = $('.J-on-sales-day').val();
		if(onSalesDay == ''){
			UBox.show('请输入上架日期', -1);
			return;
		}
		ajax({
			url : '<?php echo Url::to(['vote/save-setting']); ?>',
			data : {
				dressId : dressId,
				name : name,
				onSalesNumber : onSalesNumber,
				material : material,
				onSalesDay : onSalesDay,
				description : description,
				aSize : aSize,
				pic : getPics()
			},
			beforeSend : function(){
				$(o).attr('disabled', 'disabled');
			},
			complete : function(){
				$(o).attr('disabled', false);
			},
			success : function(aResult){
				if(aResult.status == 1){
					UBox.show(aResult.msg, aResult.status, function(){
						location.href = '<?php echo Url::to(['vote/show-list']); ?>';
					}, 3);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	}
	
	function setPic(pic){
		var htmlStr = '\
			<li class="list-group-item J-pic-item" data-pic="' + pic + '">\
				<p><img class="img-thumbnail" src="' + App.url.resource + pic + '" alt=""></p>\
				<p><center><button type="button" class="btn btn-sm btn-danger" onclick="deletePic(this);">删除</button></center></p>\
			</li>\
		';
		$('.J-pic-list').append(htmlStr);
	}
	
	function deletePic(o){
		$(o).parent().parent().remove();
	}
	
	function getPics(){
		var aPics = [];
		if($('.J-pic-list li').length == 0){
			UBox.show('请上传图片', -1);
			return false;
		}
		$('.J-pic-list li').each(function(){
			aPics.push($(this).attr('data-pic'));
		});
		
		return aPics;
	}
	
	
	$(function(){
		$('.J-form-upload-btn').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['vote/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					setPic(aResult.data);
					/*currentPic = aResult.data;
					$('.J-pic-wraper').append('<p><img class="img-thumbnail" src="' + App.url.resource + currentPic + '" alt=""></p>');
					$('.J-pic-wraper').show();*/
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	});
</script>