<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('服饰管理');
$this->registerAssetBundle('home\assets\UmeditorAsset');
$this->registerAssetBundle('common\assets\AjaxUploadAsset');
?>
<style type="text/css">
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
	.J-input-select-list{
		width:130px;
		position:absolute;
	}
	.J-input-select-list a{
		background-color:#ddd;
	}
	
	.J-big-pic{
		position:absolute;
		height:200px;
		width:200px;
	}
	.J-big-pic img{
		height:200px;
		width:200px;
	}
	#wrapper .J-scc-pic, #wrapper .J-up-pic, #wrapper .J-down-pic{
		width:34px;
		height:34px;
		cursor:pointer;
	}
	.J-select-tag-list li{
		cursor:pointer;
	}
	#wrapper .J-scc-pic-div{
		float:left;
		width:34px;
		height:34px;
		margin-right: 10px;
	}
	#wrapper .J-scc-pic-div i{
		float:right;
		display:block;
		width: 16px;
		height: 16px;
		text-align:center;
		cursor:pointer;
		color:#ff0000;
		background:#ffffff;
		position:relative;
		top:-34px;
	}
</style>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '服饰列表',
				'url' => Url::to(['dress-manage/show-list']),
			],
			[
				'title' => $aDress ? '编辑服饰' : '添加服饰',
				'url' => Url::to(['dress-manage/show-edit']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $aDress ? '编辑服饰' : '添加服饰'; ?></h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<input class="J-id form-control" type="hidden" value="<?php echo $aDress ? $aDress['id'] : ''; ?>">
			<label>服饰名称</label>
			<input class="J-name form-control" placeholder="请输入服饰名称" value="<?php echo $aDress ? $aDress['name'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<input class="J-id form-control" type="hidden" value="<?php echo $aDress ? $aDress['id'] : ''; ?>">
			<label>服饰二级名称描述</label>
			<input class="J-desc form-control" placeholder="请输服饰二级名称描述" value="<?php echo $aDress ? $aDress['desc'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<label>服饰说明</label>
			<textarea class="J-shuo-ming form-control" rows="3" placeholder="请输入服饰说明"><?php echo $aDress ? $aDress['shuo_ming'] : ''; ?></textarea>
			<br />
		</div>
		<div class="form-group">
			<label>服饰详细</label>
			<script id="detail" class="J-detail" type="text/plain" style="height:300px;width:100%;"></script>
			<br />
		</div>
		<div class="form-group">
			<label>服饰分类</label>
			<select class="J-catalog form-control">
			<?php foreach($aDressCatalogList as $key => $aDressCatalog){ ?>
				<option value="<?php echo $aDressCatalog['id']; ?>"><?php echo $aDressCatalog['name']; ?></option>
			<?php } ?>
			</select>
			<br />
		</div>
		<div class="form-group">
			<label>性别</label>
			<select class="J-sex form-control">
				<option value="1">男</option>
				<option value="2">女</option>
			</select>
			<br />
		</div>
		<div class="form-group">
			<label>服饰价格</label>
			<input class="J-price form-control" placeholder="请输入服饰价格" value="<?php echo $aDress ? $aDress['price'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<label>优惠价格</label>
			<input class="J-discount-price form-control" placeholder="请输入优惠价格" value="<?php echo $aDress ? $aDress['discount_price'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<label>是否热门</label>
			<select class="J-is-hot form-control">
				<option value="0">否</option>
				<option value="1">是</option>
			</select>
			<br />
		</div>
		<div class="form-group">
			<label>状态</label>
			<select class="J-status form-control">
				<option value="2">上架</option>
				<option value="1">未上架</option>
				<!--<option value="0">投票</option>-->
			</select>
			<br />
		</div>
		<div class="form-group">
			<div class="checkbox">
				<label>
					<input type="checkbox" value="" class="J-dress-match-chk"><b>适用搭配</b>
				</label>
			</div>
		</div>
		<div class="J-dress-match-content form-group" style="display:none;line-height:35px;">
			<label style="float:left;">自有搭配库：</label>
			<select class="J-dress-match form-control" style="float:left;width:400px;margin-right:10px;">
			<?php foreach($aDressMatchList as $key => $aDressMatch){ ?>
				<option value="<?php echo $aDressMatch['id']; ?>"><?php echo $aDressMatch['name']; ?></option>
			<?php } ?>
			</select>
			<button type="button" class="J-add-dress-match-btn btn btn-primary" onclick="addDressMatch('vender');" style="float:left; margin-right:10px;">添加</button>
			<button type="button" class="J-add-dress-manager-match-btn btn btn-primary" onclick="addManagerDressMatch();" style="float:left;">Dms搭配库</button>
			<br />
		</div>
		<div class="J-dress-match-content row" style="display:none;">
			<div class="col-lg-12">
				<ul class="J-dress-match-list list-group"></ul>
			</div>
		</div>
		<br />
		<div class="J-pics-content form-group" style="display:none;">
			<label>服饰正反面图片</label>
			<div class="form-group">
				<button type="button" class="J-add-pics-btn btn btn-info">添加图片</button>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-pics-list list-group"></ul>
				</div>
			</div>
			<br />
		</div>
		<div class="form-group" style="margin-bottom: 0px;">
			<label>尺码颜色库存图片</label>
		</div>
		<div class="J-size-color-count form-group">
			<input type="hidden" class="J-line-input J-size-color-count-id form-control" value="0">
			<input class="J-line-input J-size form-control" placeholder="请输入服饰尺码" value="" onfocus="showSizeList(this);" onblur="removeList();">
			<input class="J-line-input J-color form-control" placeholder="请输入服饰颜色" value="" onfocus="showColorList(this);" onblur="removeList();">
			<input class="J-line-input J-count form-control" placeholder="请输入服饰数量" value="">
			<div>
				<button type="button" class="J-scc-upload-btn J-line-input btn btn-info">添加详细图片</button>
			</div>
			<img class="J-line-input J-up-pic" data-pic="" src="" title="正面图片" onmouseover="showBigPic(this);" onmouseout="removeBigPic();" style="display:none;" />
			<img class="J-line-input J-down-pic" data-pic="" src="" title="反面图片" onmouseover="showBigPic(this);" onmouseout="removeBigPic();" style="display:none;" />
			<button type="button" class="J-item-btn J-line-input btn btn-info" onclick="addSizeAndColorCount(this);" style="width:55px;">添加</button>
			<br />
		</div>
		<div class="form-group" style="margin-top:45px;">
			<label>服饰标签</label>
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-select-tag-list list-group">
					<?php foreach($aTagList as $key => $aValue){ ?>
						<li class="list-group-item" onclick="addTag(this, 1);"><p><a><?php echo $aValue['name']; ?></a></p></li>
					<?php } ?>
					</ul>
				</div>
				<br />
			</div>
			<br />
			<div class="form-group">
				<!--<input class="J-line-input J-tag form-control" placeholder="请输入服饰标签" value="" onfocus="showTagList(this);" onblur="removeList();">-->
				<input class="J-line-input J-tag form-control" placeholder="请输入服饰标签" value="">
				<button type="button" class="J-line-input btn btn-info" onclick="addTag(this);" style="width:55px;">添加</button>
				<br />
			</div>
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-tag-list list-group"></ul>
				</div>
			</div>
		</div>
		<div class="form-group" style="margin-top:45px;">
			<label>服饰面料</label>
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-select-material-list list-group">
					<?php foreach($aMaterialList as $key => $aValue){ ?>
						<li class="list-group-item" onclick="addMaterial(this, 1);"><p><a><?php echo $aValue['name']; ?></a></p></li>
					<?php } ?>
					</ul>
				</div>
				<br />
			</div>
			<br />
			<div class="form-group">
				<!--<input class="J-line-input J-tag form-control" placeholder="请输入服饰标签" value="" onfocus="showTagList(this);" onblur="removeList();">-->
				<input class="J-line-input J-material form-control" placeholder="请输入服饰面料" value="">
				<button type="button" class="J-line-input btn btn-info" onclick="addMaterial(this);" style="width:55px;">添加</button>
				<br />
			</div>
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-material-list list-group"></ul>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<button type="button" class="J-save-btn btn btn-primary" onclick="save(this);">保存服饰</button>
		</div>
	</div>
</div>
<div class="J-x-content-rule" style="display:none"><?php echo $aDress ? $aDress['detail'] : ''; ?></div>
<script type="text/javascript">
	var maxPicCount = 2;
	var aDress = <?php echo json_encode($aDress); ?>;
	var aDressCatalogList = <?php echo json_encode($aDressCatalogList); ?>;
	var aManagerDressMatchList = <?php echo json_encode($aManagerDressMatchList); ?>;
	var aDressCatalogChildList = <?php echo json_encode($aDressCatalogChildList); ?>;
	var aSizeColorList = <?php echo json_encode($aSizeColorList); ?>;
	var aTagList = <?php echo json_encode($aTagList); ?>;
	var aMaterialList = <?php echo json_encode($aMaterialList); ?>;
	var oCurrentInputDom = {};
	
	function init(){
		if(typeof(aDress.dress_size_color_count) != 'undefined'){
			var oDom = $('.J-size-color-count');
			for(var i in aDress.dress_size_color_count){
				var aTemp = aDress.dress_size_color_count[i];
				var htmlStr = buildSCCHtml(aTemp.id, aTemp.size_name, aTemp.color_name, aTemp.stock, aTemp.pic, aTemp.pics);
				var oTempDom = $(htmlStr);
				oDom.after(oTempDom);
				oDom.find('button.J-item-btn ').text('删除');
				oDom.find('button.J-item-btn ').attr('onclick', 'delSizeAndColorCount(this);');
				oDom = oTempDom;
			}
			$('.J-size-color-count')[0].remove();
		}else{
			$('.J-scc-upload-btn').AjaxUpload({
				uploadUrl : '<?php echo Url::to(['dress-manage/upload-file']); ?>',
				fileKey : 'image',
				callback : function(aResult, oThis){
					if(aResult.status == 1){
						oThis.before('<div class="J-scc-pic-div"><img class="J-line-input J-scc-pic" data-pic="' + aResult.data + '" src="' + App.url.resource + aResult.data + '" title="详细图片" onmouseover="showBigPic(this);" onmouseout="removeBigPic();" /><i onclick="deleteSccPic(this);">×</i></div>');
					}else{
						UBox.show(aResult.msg, aResult.status);
					}
				}
			});
			$('.J-scc-pic').AjaxUpload({
				uploadUrl : '<?php echo Url::to(['dress-manage/upload-file']); ?>',
				fileKey : 'image',
				callback : function(aResult, oThis){
					if(aResult.status == 1){
						oThis.attr('src', App.url.resource + aResult.data);
						oThis.attr('data-pic', aResult.data);
					}else{
						UBox.show(aResult.msg, aResult.status);
					}
				}
			});
			$('.J-up-pic').AjaxUpload({
				uploadUrl : '<?php echo Url::to(['dress-manage/upload-file']); ?>',
				fileKey : 'image',
				callback : function(aResult, oThis){
					if(aResult.status == 1){
						oThis.attr('src', App.url.resource + aResult.data);
						oThis.attr('data-pic', aResult.data);
					}else{
						UBox.show(aResult.msg, aResult.status);
					}
				}
			});
			$('.J-down-pic').AjaxUpload({
				uploadUrl : '<?php echo Url::to(['dress-manage/upload-file']); ?>',
				fileKey : 'image',
				callback : function(aResult, oThis){
					if(aResult.status == 1){
						oThis.attr('src', App.url.resource + aResult.data);
						oThis.attr('data-pic', aResult.data);
					}else{
						UBox.show(aResult.msg, aResult.status);
					}
				}
			});
		}
		if(aDress.dress_tag != 0){
			for(var i in aDress.dress_tag){
				$('.J-tag-list').append(buildTagHtml(aDress.dress_tag[i].name));
			}
		}
		if(aDress.dress_material != 0){
			for(var i in aDress.dress_material){
				$('.J-material-list').append(buildMaterialHtml(aDress.dress_material[i].name));
			}
		}
		if(aDress.pics != 0){
			for(var i in aDress.pics){
				addPic(aDress.pics[i]);
			}
		}
	}
	
	function checkSCC(aData){
		for(var i in aData){
			if(aData.length != 1 && aData[i].size == '' && aData[i].color == '' && aData[i].count == ''){
				continue;
			}
			if(aData[i].size == ''){
				UBox.show('请填写第' + (parseInt(i) + 1) + '项尺码', -1);
				return false;
			}
			if(aData[i].color == ''){
				UBox.show('请填写第' + (parseInt(i) + 1) + '项颜色', -1);
				return false;
			}
			if(aData[i].count == ''){
				UBox.show('请填写第' + (parseInt(i) + 1) + '项数量', -1);
				return false;
			}
		}
		return true;
	}
	
	function getSizeColorCount(){
		var aSizeColorCount = [];
		if($('.J-size-color-count').length == 1){
			var aTemp = {
				id : $('.J-size-color-count-id').val(), 
				size : $('.J-size').val(), 
				color : $('.J-color').val(), 
				count : $('.J-count').val(),
				pic : $('.J-scc-pic').attr('data-pic'),
				pics : [$('.J-up-pic').attr('data-pic'), $('.J-down-pic').attr('data-pic')]
			};
			aSizeColorCount.push(aTemp);
		}else{
			$('.J-size-color-count').each(function(){
				var aPic = [];
				$(this).find('.J-scc-pic').each(function(){
					aPic.push($(this).attr('data-pic'));
				});
				var aTemp = {
					id : $(this).find('.J-size-color-count-id').val(), 
					size : $(this).find('.J-size').val(), 
					color : $(this).find('.J-color').val(), 
					count : $(this).find('.J-count').val(),
					pic : aPic,
					pics : [$(this).find('.J-up-pic').attr('data-pic'), $(this).find('.J-down-pic').attr('data-pic')]
				};
				aSizeColorCount.push(aTemp);
			});
		}
		return aSizeColorCount;
	}
	
	function getTag(){
		var aTag = [];
		if($('.J-tag-list li').length == 0){
			UBox.show('请添加服饰标签', -1);
			return false;
		}
		$('.J-tag-list li').each(function(){
			aTag.push($(this).find('a').text());
		});
		
		return aTag;
	}
	
	function getMaterial(){
		var aMaterial = [];
		if($('.J-material-list li').length == 0){
			UBox.show('请添加服饰面料', -1);
			return false;
		}
		$('.J-material-list li').each(function(){
			aMaterial.push($(this).find('a').text());
		});
		
		return aMaterial;
	}
	
	function getDressMatch(){
		var aList = {'vender' : [], 'manager' : []};
		$('.J-dress-match-list li').each(function(){
			aList[$(this).attr('data-type')].push($(this).attr('data-id'));
		});
		
		return aList;
	}

	function getPics(){
		var aPics = [];
		/*if($('.J-pics-list li').length == 0){
			UBox.show('请上传服饰图片', -1);
			return false;
		}*/
		$('.J-pics-list li').each(function(){
			aPics.push($(this).attr('data-pic'));
		});
		
		return aPics;
	}

	function save(o){
		var id = $('.J-id').val();
		var name = $('.J-name').val();
		var desc = $('.J-desc').val();
		var shuoMing = $('.J-shuo-ming').val();
		var catalogId = $('.J-catalog').val();
		var price = $('.J-price').val();
		var discountPrice = $('.J-discount-price').val();
		var status = $('.J-status').val();
		var isHot = $('.J-is-hot').val();
		var sex = $('.J-sex').val();
		if(name == ''){
			UBox.show('请填写服饰名称', -1);
			return;
		}
		if(price == ''){
			UBox.show('请填写服饰价格', -1);
			return;
		}
		var aSizeColorCount = getSizeColorCount();
		if(!checkSCC(aSizeColorCount)){
			return;
		}
		var aTag = getTag();
		if(!aTag){
			return;
		}
		var aMaterial = getMaterial();
		if(!aMaterial){
			return;
		}
		var aPics = getPics();
		/*if(!aPics){
			return;
		}*/
		var aDressMatchIds = [];
		if($('.J-dress-match-chk').is(':checked')){
			aDressMatchIds = getDressMatch();
		}else{
			aPics = [];
		}
		var detail = $('.J-detail').text();
		if(detail){
			detail = $('.J-detail').html();
		}
		ajax({
			url : '<?php echo Url::to(['dress-manage/save']); ?>',
			data : {
				id : id,
				name : name,
				desc : desc,
				detail : detail,
				shuoMing : shuoMing,
				catalogId : catalogId,
				price : price,
				discountPrice : discountPrice,
				status : status,
				isHot : isHot,
				sex : sex,
				aSizeColorCount : aSizeColorCount,
				aTag : aTag,
				aMaterial : aMaterial,
				aPics : aPics,
				aDressMatchIds : aDressMatchIds
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
						location.href = '<?php echo Url::to(['dress-manage/show-list']); ?>';
					}, 3);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	}
	
	function buildSCCHtml(id, size, color, count, img, pics){
		var upImgSrc = '';
		var downImgSrc = '';
		var upImg = '';
		var downImg = '';
		var imgSrc = '';
		var imgSrcHtml = '';
		
		if(img.length != 0){
			for(var i in img){
				imgSrcHtml += '<div class="J-scc-pic-div"><img class="J-line-input J-scc-pic" data-pic="' + img[i] + '" src="' + App.url.resource + img[i] + '" title="详细图片" onmouseover="showBigPic(this);" onmouseout="removeBigPic();" /><i onclick="deleteSccPic(this);">×</i></div>';
			}
		}
		if(typeof(pics[0]) != 'undefined' && pics[0] != ''){
			upImg = pics[0];
			upImgSrc = App.url.resource + upImg;
		}
		if(typeof(pics[1]) != 'undefined' && pics[1] != ''){
			downImg = pics[1];
			downImgSrc = App.url.resource + downImg;
		}
		var oDom = $('<div class="J-size-color-count form-group">\
				<input type="hidden" class="J-line-input J-size-color-count-id form-control" value="' + id + '">\
				<input class="J-line-input J-size form-control" placeholder="请输入服饰尺码" value="' + size + '" onfocus="showSizeList(this);" onblur="removeList();">\
				<input class="J-line-input J-color form-control" placeholder="请输入服饰颜色" value="' + color + '" onfocus="showColorList(this);" onblur="removeList();">\
				<input class="J-line-input J-count form-control" placeholder="请输入服饰数量" value="' + count + '">\
				<div>\
					' + imgSrcHtml + '\
					<button type="button" class="J-scc-upload-btn J-line-input btn btn-info">添加详细图片</button>\
				</div>\
				<img class="J-line-input J-up-pic" data-pic="' + upImg + '" src="' + upImgSrc + '" title="正面图片" onmouseover="showBigPic(this);" onmouseout="removeBigPic();" style="display:none;" />\
				<img class="J-line-input J-down-pic" data-pic="' + downImg + '" src="' + downImgSrc + '" title="反面图片" onmouseover="showBigPic(this);" onmouseout="removeBigPic();" style="display:none;" />\
				<button type="button" class="J-item-btn J-line-input btn btn-info" onclick="addSizeAndColorCount(this);" style="width:55px;">添加</button>\
				<br />\
			</div>\
		');
		
		oDom.find('.J-scc-upload-btn').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['dress-manage/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					oDom.find('.J-scc-upload-btn').before('<div class="J-scc-pic-div"><img class="J-line-input J-scc-pic" data-pic="' + aResult.data + '" src="' + App.url.resource + aResult.data + '" title="详细图片" onmouseover="showBigPic(this);" onmouseout="removeBigPic();" /><i onclick="deleteSccPic(this);">×</i></div>');
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
		/*oDom.find('.J-scc-pic').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['dress-manage/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					oDom.find('.J-scc-pic').attr('src', App.url.resource + aResult.data);
					oDom.find('.J-scc-pic').attr('data-pic', aResult.data);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});*/
		oDom.find('.J-up-pic').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['dress-manage/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					oDom.find('.J-up-pic').attr('src', App.url.resource + aResult.data);
					oDom.find('.J-up-pic').attr('data-pic', aResult.data);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
		oDom.find('.J-down-pic').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['dress-manage/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					oDom.find('.J-down-pic').attr('src', App.url.resource + aResult.data);
					oDom.find('.J-down-pic').attr('data-pic', aResult.data);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
		if($('.J-dress-match-chk').is(':checked')){
			oDom.find('.J-up-pic').show();
			oDom.find('.J-down-pic').show();
		}else{
			oDom.find('.J-up-pic').hide();
			oDom.find('.J-down-pic').hide();
		}
		return oDom;
	}
	
	function removeBigPic(){
		$('.J-big-pic').remove();
	}
	
	function showBigPic(o, e){
		var oDom = $('<div class="J-big-pic"><img class="img-thumbnail" src="' + $(o).attr('src') + '" alt=""></div>');
		$('body').append(oDom);
		oDom.css({top: $(o).offset().top + 40, left: $(o).offset().left + 40});
	}
	
	function addSizeAndColorCount(o){
		$(o).parent().after(buildSCCHtml(0, '', '', '', '', ['', '']));
		$(o).text('删除');
		$(o).attr('onclick', 'delSizeAndColorCount(this);');
	}
	
	function delSizeAndColorCount(o){
		$(o).parent().remove();
	}
	
	function addTag(o, type){
		if($('.J-tag-list li').length >= 3){
			UBox.show('最多只能添加3个服饰标签', -1);
			return false;
		}
		var tag = $('.J-tag').val();
		if(type){
			tag = $(o).find('a').text();
		}
		if(tag == ''){
			UBox.show('标签不能为空', -1);
			return;
		}
		$('.J-tag-list').append(buildTagHtml(tag));
		$('.J-tag').val('');
	}
	
	function addMaterial(o, type){
		if($('.J-material-list li').length >= 3){
			UBox.show('最多只能添加3个服饰面料', -1);
			return false;
		}
		var material = $('.J-material').val();
		if(type){
			material = $(o).find('a').text();
		}
		if(material == ''){
			UBox.show('标签不能为空', -1);
			return;
		}
		$('.J-material-list').append(buildMaterialHtml(material));
		$('.J-material').val('');
	}
	
	function buildTagHtml(tag){
		return '<li class="list-group-item"><p><a>' + tag + '</a><i onclick="deleteTag(this);">&nbsp;&nbsp;×</i></p></li>';
	}
	
	function buildMaterialHtml(tag){
		return '<li class="list-group-item"><p><a>' + tag + '</a><i onclick="deleteMaterial(this);">&nbsp;&nbsp;×</i></p></li>';
	}
	
	function buildDressMatchHtml(type, id, txt){
		return '<li class="list-group-item" data-type="' + type + '" data-id="' + id + '"><p><a>' + txt + '</a><i onclick="deleteDressMatch(this);">&nbsp;&nbsp;×</i></p></li>';
	}
		
	function deleteDressMatch(o){
		$(o).parent().parent().remove();
	}
		
	function deleteSccPic(o){
		$(o).parent().remove();
	}
		
	function deleteTag(o){
		$(o).parent().parent().remove();
	}
		
	function deleteMaterial(o){
		$(o).parent().parent().remove();
	}
	
	function addDressMatch(type, id, txt){
		if(!id){
			id = $('.J-dress-match').val();
		}
		if(!txt){
			//txt = $('.J-dress-match').text();
			txt = $('.J-dress-match').find("option:selected").text();
		}
		var aList = getDressMatch();
		if(JsTools.inArray(id, aList[type])){
			UBox.show('已添加过了哦', -1);
			return;
		}
		$('.J-dress-match-list').append(buildDressMatchHtml(type, id, txt));
	}
	
	function deletePic(o){
		$(o).parent().parent().remove();
	}
	
	function addPic(pic){
		var htmlStr = '\
			<li class="list-group-item J-pic-item" data-pic="' + pic + '">\
				<p><img class="img-thumbnail" src="' + App.url.resource + pic + '" alt=""></p>\
				<p><center><button type="button" class="btn btn-sm btn-danger" onclick="deletePic(this);">删除</button></center></p>\
			</li>\
		';
		$('.J-pics-list').append(htmlStr);
	}
	
	function showSizeList(o){
		oCurrentInputDom = $(o);
		$('.J-input-select-list').remove();
		var htmlStr = '<div class="J-input-select-list list-group">';
		for(var i in aSizeColorList.size_list){
			htmlStr += '<a href="javascript:;" class="list-group-item" onclick="setValue(this);">' + aSizeColorList.size_list[i].size_name + '</a>';
		}
		htmlStr += '</div>';
		$('body').append(htmlStr);
		$('.J-input-select-list').css({top : $(o).offset().top + 35});
		$('.J-input-select-list').css({left : $(o).offset().left});
	}
	
	function showColorList(o){
		oCurrentInputDom = $(o);
		$('.J-input-select-list').remove();
		var htmlStr = '<div class="J-input-select-list list-group">';
		for(var i in aSizeColorList.color_list){
			htmlStr += '<a href="javascript:;" class="list-group-item" onclick="setValue(this);">' + aSizeColorList.color_list[i].color_name + '</a>';
		}
		htmlStr += '</div>';
		$('body').append(htmlStr);
		$('.J-input-select-list').css({top : $(o).offset().top + 35});
		$('.J-input-select-list').css({left : $(o).offset().left});
	}
		
	function showTagList(o){
		oCurrentInputDom = $(o);
		$('.J-input-select-list').remove();
		var htmlStr = '<div class="J-input-select-list list-group">';
		for(var i in aTagList){
			htmlStr += '<a href="javascript:;" class="list-group-item" onclick="setValue(this);">' + aTagList[i].name + '</a>';
		}
		htmlStr += '</div>';
		$('body').append(htmlStr);
		$('.J-input-select-list').css({top : $(o).offset().top + 35});
		$('.J-input-select-list').css({left : $(o).offset().left});
	}
		
	function showMaterialList(o){
		oCurrentInputDom = $(o);
		$('.J-input-select-list').remove();
		var htmlStr = '<div class="J-input-select-list list-group">';
		for(var i in aMaterialList){
			htmlStr += '<a href="javascript:;" class="list-group-item" onclick="setValue(this);">' + aTagList[i].name + '</a>';
		}
		htmlStr += '</div>';
		$('body').append(htmlStr);
		$('.J-input-select-list').css({top : $(o).offset().top + 35});
		$('.J-input-select-list').css({left : $(o).offset().left});
	}
	
	function setValue(o){
		oCurrentInputDom.val($(o).text());
		removeList(o);
	}
	
	function removeList(o){
		var oDom = $('.J-input-select-list');
		if(o){
			oDom = $(o).parent();
		}
		setTimeout(function(){
			oDom.remove();
		}, 200);
	}
	
	function buildDmsBoxHtml(){
		var htmlStr = '';
		htmlStr += '\
			<div class="J-dms-win" style="height:560px;max-width:1000px;">\
				<div style="height:160px;">\
					<div class="form-group" style="height:80px; margin-bottom:0px;">\
						<label>服饰分类</label>\
						<select class="J-dms-catalog form-control">\
						<?php foreach($aDressCatalogList as $key => $aValue){ ?>\
							<option value="<?php echo $aValue['id']; ?>"><?php echo $aValue['name']; ?></option>\
						<?php } ?>\
						</select>\
					</div>\
					<div class="form-group" style="height:80px;">\
						<label>服饰子分类</label>\
						<select class="J-dms-catalog-id form-control">\
						<?php foreach($aDressCatalogChildList as $k => $aChild){ ?>\
							<option value="<?php echo $aChild['id']; ?>"><?php echo $aChild['name']; ?></option>\
						<?php } ?>\
						</select>\
					</div>\
				</div>\
				<div style="height:400px;max-width:1000px; overflow-y:auto;">\
					<div class="form-group" style="width:500px;">\
						<div class="row">\
							<div class="col-lg-12">\
								<ul class="J-dms-pics-list list-group"></ul>\
							</div>\
						</div>\
						<br />\
					</div>\
				</div>\
			</div>\
		';
		return htmlStr;
	}
	
	function showDmsPicsByCatalogId(id){
		$('.J-dms-pics-list').html('');
		for(var i in aManagerDressMatchList){
			if(aManagerDressMatchList[i].catalog_id == id){
				if(typeof(aManagerDressMatchList[i].pics[0]) != 'undefined'){
					addDmsPic(aManagerDressMatchList[i].id, aManagerDressMatchList[i].name, aManagerDressMatchList[i].pics[0]);
				}
			}
		}
	}
	
	function addDmsPic(id, txt, pic){
		var htmlStr = '\
			<li class="list-group-item J-pic-item" data-pic="' + pic + '">\
				<p><img class="img-thumbnail" src="' + App.url.resource + pic + '" alt=""></p>\
				<p><center><button type="button" class="btn btn-sm btn-danger" onclick="addDressMatch(\'manager\', ' + id + ', \'' + txt + '\');">添加</button></center></p>\
			</li>\
		';
		$('.J-dms-pics-list').append(htmlStr);
	}
	
	function showChildCatalog(id){
		var htmlStr = '';
		for(var i in aDressCatalogChildList){
			if(aDressCatalogChildList[i].pid == id){
				htmlStr += '<option value="' + aDressCatalogChildList[i].id + '">' + aDressCatalogChildList[i].name + '</option>';
			}
		}
		
		$('.J-dms-catalog-id').html(htmlStr);
	}
	
	function addManagerDressMatch(){
		$.teninedialog({
			title : 'Dms搭配库',
			content : buildDmsBoxHtml(),
			url : '',
			showCloseButton : false,
			otherButtons : ['确定'],
			otherButtonStyles : ['btn-primary'],
			bootstrapModalOption : {keyboard: true},
			dialogShow : function(){
				//alert('即将显示对话框');
			},
			dialogShown : function(){
				$('.J-dms-catalog').on('change', function(){
					showChildCatalog($(this).val());
					showDmsPicsByCatalogId($('.J-dms-catalog-id').val());
				});
				$('.J-dms-catalog-id').on('change', function(){
					showDmsPicsByCatalogId($(this).val());console.log($(this).val());
				});
				showDmsPicsByCatalogId($('.J-dms-catalog-id').val());
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
		<?php if($aDress){ ?>
		$('.J-status').val(<?php echo $aDress['status']; ?>);
		$('.J-is-hot').val(<?php echo $aDress['is_hot']; ?>);
		$('.J-sex').val(<?php echo $aDress['sex']; ?>);
		<?php } ?>
		init();
		$('.J-add-pics-btn').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['dress-manage/upload-file']); ?>',
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
		});
		$('.J-dress-match-chk').on('click', function(){
			if($(this).is(':checked')){
				$('.J-dress-match-content').show();
				//$('.J-pics-content').show();
				$('.J-pics-content').hide();
				$('.J-up-pic').show();
				$('.J-down-pic').show();
			}else{
				$('.J-dress-match-content').hide();
				$('.J-pics-content').hide();
				$('.J-up-pic').hide();
				$('.J-down-pic').hide();
			}
		});
		<?php if($aDress && $aDress['dress_match_ids']){ ?>
			$('.J-dress-match-chk').click();
			if(typeof(aDress.dress_match_ids.vender) != 'undefined'){
				for(var i in aDress.dress_match_ids.vender){
					$('.J-dress-match').val(aDress.dress_match_ids.vender[i]);
					addDressMatch('vender');
				}
			}
			if(typeof(aDress.dress_match_ids.manager) != 'undefined'){
				for(var i in aDress.dress_match_ids.manager){
					for(var j in aManagerDressMatchList){
						if(aDress.dress_match_ids.manager[i] == aManagerDressMatchList[j].id){
							addDressMatch('manager', aManagerDressMatchList[j].id, aManagerDressMatchList[j].name);
						}
					}
				}
			}
		<?php } ?>
		
		UM.getEditor('detail', {
			/*toolbar:[
				'emotion image insertvideo | bold forecolor | justifyleft justifycenter justifyright  | removeformat |',
				'link'
			],*/
			imageUrl : '<?php echo Url::to(['dress-manage/upload-file']); ?>',
			imagePath : '<?php echo Yii::getAlias('@r.url'); ?>',
			imageFieldName : 'image'
		}).ready(function() {
		   this.setContent($('.J-x-content-rule').html());
		   $('.J-x-content-rule').remove();
		});
	});
</script>