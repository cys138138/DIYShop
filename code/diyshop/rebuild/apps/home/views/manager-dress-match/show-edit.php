<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('搭配管理');
$this->registerAssetBundle('common\assets\AjaxUploadAsset');
?>

<style type="text/css">
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
				'title' => '搭配列表',
				'url' => Url::to(['manager-dress-match/show-list']),
			],
			[
				'title' => $aDressMatch ? '编辑搭配' : '添加搭配',
				'url' => Url::to(['manager-dress-match/show-edit']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $aDressMatch ? '编辑搭配' : '添加搭配'; ?></h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<label>搭配别名</label>
			<input class="J-name form-control" placeholder="搭配别名" value="<?php echo $aDressMatch ? $aDressMatch['name'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<input class="J-id form-control" type="hidden" value="<?php echo $aDressMatch ? $aDressMatch['id'] : ''; ?>">
			<label>服饰分类</label>
			<select class="J-catalog form-control">
			<?php foreach($aDressCatalogList as $key => $aValue){ ?>
				<option value="<?php echo $aValue['id']; ?>"><?php echo $aValue['name']; ?></option>
			<?php } ?>
			</select>
			<br />
		</div>
		<div class="form-group">
			<label>性别</label>
			<select class="J-sex form-control">
				<option value="<?php echo \common\model\User::SEX_BOY; ?>">男</option>
				<option value="<?php echo \common\model\User::SEX_GIRL; ?>">女</option>
			</select>
			<br />
		</div>
		<div class="form-group">
			<label>价格</label>
			<input class="J-price form-control" placeholder="价格" value="<?php echo $aDressMatch ? $aDressMatch['price'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<label>服饰子分类</label>
			<select class="J-catalog-id form-control">
			<?php foreach($aDressCatalogChildList as $k => $aChild){ ?>
				<option value="<?php echo $aChild['id']; ?>"><?php echo $aChild['name']; ?></option>
			<?php } ?>
			</select>
			<br />
		</div>
		<!--<div class="form-group">
			<label>搭配正反面图片</label>
			<div class="form-group">
				<button type="button" class="J-add-pics-btn btn btn-info">上传搭配正反面图片</button>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-pics-list list-group"></ul>
				</div>
			</div>
			<br />
		</div>-->
		<div class="form-group">
			<label>搭配正面图片</label>
			<div class="form-group">
				<button type="button" class="J-add-zhen-pics-btn btn btn-info">上传搭配正面图片</button>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-zhen-pics-list list-group"></ul>
				</div>
			</div>
			<br />
		</div>
		<div class="form-group">
			<label>搭配反面图片</label>
			<div class="form-group">
				<button type="button" class="J-add-fan-pics-btn btn btn-info">上传搭配反面图片</button>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-fan-pics-list list-group"></ul>
				</div>
			</div>
			<br />
		</div>
		<div class="form-group">
			<button type="button" class="J-save-btn btn btn-primary" onclick="save(this);">保存</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	var maxPicCount = 2;
	var aDressCatalogChildList = <?php echo json_encode($aDressCatalogChildList); ?>;
	function getPics(){
		var aPics = [];
		if($('.J-pics-list li').length == 0){
			UBox.show('请上传图片', -1);
			return false;
		}
		$('.J-pics-list li').each(function(){
			aPics.push($(this).attr('data-pic'));
		});
		
		return aPics;
	}
	
	function deletePic(o){
		$(o).parent().parent().remove();
	}
	
	/*function addPic(pic){
		var htmlStr = '\
			<li class="list-group-item J-pic-item" data-pic="' + pic + '">\
				<p><img class="img-thumbnail" src="' + App.url.resource + pic + '" alt=""></p>\
				<p><center><button type="button" class="btn btn-sm btn-danger" onclick="deletePic(this);">删除</button></center></p>\
			</li>\
		';
		$('.J-pics-list').append(htmlStr);
	}*/
	
	function setZhenFanPic(zhenPic, fanPic){
		if(zhenPic){
			var htmlStr = '\
				<li class="list-group-item J-pic-item" data-pic="' + zhenPic + '">\
					<p><img class="img-thumbnail" src="' + App.url.resource + zhenPic + '" alt=""></p>\
					<p><center><button type="button" class="btn btn-sm btn-danger" onclick="deletePic(this);">删除</button></center></p>\
				</li>\
			';
			$('.J-zhen-pics-list').html(htmlStr);
		}
		if(fanPic){
			var htmlStr = '\
				<li class="list-group-item J-pic-item" data-pic="' + fanPic + '">\
					<p><img class="img-thumbnail" src="' + App.url.resource + fanPic + '" alt=""></p>\
					<p><center><button type="button" class="btn btn-sm btn-danger" onclick="deletePic(this);">删除</button></center></p>\
				</li>\
			';
			$('.J-fan-pics-list').html(htmlStr);
		}
	}
	
	function save(o){
		var id = $('.J-id').val();
		var name = $('.J-name').val();
		var price = $('.J-price').val();
		var sex = $('.J-sex').val();
		var catalogId = $('.J-catalog-id').val();
		//var aPics = getPics();
		var aPics = [];
		if(name == ''){
			UBox.show('请填写搭配别名', -1);
			return;
		}
		/*if(!aPics){
			UBox.show('请上传图片', -1);
			return;
		}*/
		var zhenPic = $('.J-zhen-pics-list li').attr('data-pic');
		var fanPic = $('.J-fan-pics-list li').attr('data-pic');
		ajax({
			url : '<?php echo Url::to(['manager-dress-match/save']); ?>',
			data : {
				id : id,
				name : name,
				price : price,
				sex : sex,
				catalogId : catalogId,
				aPics : aPics,
				zhenPic : zhenPic,
				fanPic : fanPic
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
						location.href = '<?php echo Url::to(['manager-dress-match/show-list']); ?>';
					}, 3);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	}
	
	function showChildCatalog(id){
		var htmlStr = '';
		for(var i in aDressCatalogChildList){
			if(aDressCatalogChildList[i].pid == id){
				htmlStr += '<option value="' + aDressCatalogChildList[i].id + '">' + aDressCatalogChildList[i].name + '</option>';
			}
		}
		
		$('.J-catalog-id').html(htmlStr);
	}
	
	$(function(){
		showChildCatalog($('.J-catalog').val());
		$('.J-catalog').on('change', function(){
			showChildCatalog($(this).val());
		});
		
		/*$('.J-add-pics-btn').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['manager-dress-match/upload-file']); ?>',
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
					addPic(aResult.data);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});*/
		$('.J-add-zhen-pics-btn').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['manager-dress-match/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					setZhenFanPic(aResult.data, '');
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
		$('.J-add-fan-pics-btn').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['manager-dress-match/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					setZhenFanPic('', aResult.data);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
		<?php if($aDressMatch){ ?>
			$('.J-catalog').val(<?php echo $aDressMatch['dress_catalog']['pid']; ?>);
			$('.J-catalog').change();
			$('.J-sex').val(<?php echo $aDressMatch['sex']; ?>);
			setZhenFanPic('<?php echo $aDressMatch['zhen_pic']; ?>', '<?php echo $aDressMatch['fan_pic']; ?>');
			setTimeout(function(){
				$('.J-catalog-id').val(<?php echo $aDressMatch['dress_catalog']['id']; ?>);
			}, 1000);
			/*<?php foreach($aDressMatch['pics'] as $value){ ?>
				addPic('<?php echo $value; ?>');
			<?php } ?>*/
		<?php } ?>
	});
</script>