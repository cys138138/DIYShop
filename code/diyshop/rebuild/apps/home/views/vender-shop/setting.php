<?php 
use umeworld\lib\Url;
use home\widgets\ModuleNavi;
$this->setTitle('商店设置');
$this->registerAssetBundle('common\assets\AjaxUploadAsset');
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
	.J-logo{
		cursor:pointer;
	}
</style>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '商店设置',
				'url' => Url::to(['vender-shop/show-setting']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">商店设置</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<label>商店名称</label>
			<input class="J-name form-control" placeholder="请输入商店名称" value="<?php echo $aVenderShop ? $aVenderShop['name'] : ''; ?>">
		</div>
		<div class="form-group">
			<label>商店说明</label>
			<textarea class="J-description form-control" rows="3" placeholder="请输入商店说明"><?php echo $aVenderShop ? $aVenderShop['description'] : ''; ?></textarea>
		</div>
		<div class="form-group">
			<label>客服电话</label>
			<input class="J-kefu-tel form-control" placeholder="请输入客服电话" value="<?php echo $aVenderShop ? $aVenderShop['kefu_tel'] : ''; ?>">
		</div>
		<div class="form-group">
			<label>QQ号</label>
			<input class="J-qq form-control" placeholder="请输入QQ号" value="<?php echo $aVenderShop ? $aVenderShop['qq'] : ''; ?>">
		</div>
		<div class="form-group">
			<label>微信号</label>
			<input class="J-weixin form-control" placeholder="请输入微信号" value="<?php echo $aVenderShop ? $aVenderShop['weixin'] : ''; ?>">
		</div>
		<div class="form-group">
			<label>商店Logo</label>
			<img class="J-logo img-thumbnail" data-pic="<?php echo $aVenderShop ? $aVenderShop['logo'] : ''; ?>" src="<?php echo $aVenderShop ? Yii::getAlias('@r.url') . $aVenderShop['logo'] : 'http://placehold.it/100x100'; ?>" width="100" height="100" alt="">
		</div>
		<div class="form-group">
			<label>轮播图片</label>
			<div class="col-lg-12" style="border:1px solid #ccc;margin-bottom:10px;">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-12">
							<ul class="J-pics-list list-group"></ul>
						</div>
					</div>
				</div>
				<br />
				<div class="form-group">
					<button type="button" class="J-upload-logo-btn btn btn-primary">添加图片</button>
				</div>
			</div>
		</div>
		<br />
		<div class="form-group" style="margin-top:100px;">
			<button type="button" class="J-save-btn btn btn-primary" onclick="save(this);">保存设置</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	var maxPicCount = 5;
	var aVenderShop = <?php echo json_encode($aVenderShop); ?>;
	function bulidImgHtml(pic){
		var htmlStr = '\
			<li class="list-group-item" data-pic="' + pic + '">\
				<p><img class="img-thumbnail" src="' + App.url.resource + pic + '" alt=""></p>\
				<p><center><button type="button" class="btn btn-sm btn-danger" onclick="deletePic(this, \'' + pic + '\');">删除</button></center></p>\
			</li>\
		';
		return htmlStr;
	}
	
	function showPics(aPics){
		var htmlStr = '';
		for(var i in aPics){
			htmlStr += bulidImgHtml(aPics[i]);
		}
		$('.J-pics-list').html(htmlStr);
	}
	
	function deletePic(o, pic){
		$(o).parent().parent().remove();
		updatePicsData();
	}
	
	function updatePicsData(){
		var aPicData = [];
		$('.J-pics-list li').each(function(){
			aPicData.push($(this).attr('data-pic'));
		});
		aVenderShop.pics = aPicData;
	}
	
	function checkLimit(){
		return true;
	}
	
	function save(o){
		var name = $('.J-name').val();
		var description = $('.J-description').val();
		var logo = $('.J-logo').attr('data-pic');
		var kefuTel = $('.J-kefu-tel').val();
		var qq = $('.J-qq').val();
		var weixin = $('.J-weixin').val();
		var aPics = aVenderShop.pics;
		ajax({
			url : '<?php echo Url::to(['vender-shop/save-setting']); ?>',
			data : {
				name : name,
				description : description,
				logo : logo,
				kefuTel : kefuTel,
				qq : qq,
				weixin : weixin,
				aPics : aPics
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
		showPics(aVenderShop.pics);
		$('.J-logo').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['vender-shop/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					$('.J-logo').attr('src', App.url.resource + aResult.data);
					$('.J-logo').attr('data-pic', aResult.data);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
		$('.J-upload-logo-btn').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['vender-shop/upload-file']); ?>',
			fileKey : 'image',
			isUploadEnable : function(o){
				if(parseInt($('.J-pics-list li').length) >= maxPicCount){
					UBox.show('只能上传 ' + maxPicCount + ' 张图片！', -1);
					return false;
				}
				return true;
			},
			callback : function(aResult){
				if(aResult.status == 1){
					$('.J-pics-list').append(bulidImgHtml(aResult.data));
					updatePicsData();
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	});
</script>