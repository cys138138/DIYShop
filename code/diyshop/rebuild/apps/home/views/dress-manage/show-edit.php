<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('服饰管理');
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
	#wrapper .J-scc-pic{
		width:34px;
		height:34px;
		cursor:pointer;
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
			<label>服饰分类</label>
			<select class="J-catalog form-control">
			<?php foreach($aDressCatalogList as $key => $aDressCatalog){ ?>
				<option value="<?php echo $aDressCatalog['id']; ?>"><?php echo $aDressCatalog['name']; ?></option>
			<?php } ?>
			</select>
			<br />
		</div>
		<div class="form-group">
			<label>服饰价格</label>
			<input class="J-price form-control" placeholder="请输入服饰价格" value="<?php echo $aDress ? $aDress['price'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<label>状态</label>
			<select class="J-status form-control">
				<option value="2">上架</option>
				<option value="1">未上架</option>
			</select>
			<br />
		</div>
		<div class="form-group" style="margin-bottom: 0px;">
			<label>尺码颜色库存图片</label>
		</div>
		<div class="J-size-color-count form-group">
			<input class="J-line-input J-size form-control" placeholder="请输入服饰尺码" value="" onfocus="showSizeList(this);" onblur="removeList();">
			<input class="J-line-input J-color form-control" placeholder="请输入服饰颜色" value="" onfocus="showColorList(this);" onblur="removeList();">
			<input class="J-line-input J-count form-control" placeholder="请输入服饰数量" value="">
			<img class="J-line-input J-scc-pic" data-pic="" src="" title="上传图片" onmouseover="showBigPic(this);" onmouseout="removeBigPic();" />
			<button type="button" class="J-line-input btn btn-info" onclick="addSizeAndColorCount(this);" style="width:55px;">添加</button>
			<br />
		</div>
		<div class="form-group" style="margin-top:45px;">
			<label>服饰标签</label>		
			<div class="form-group">
				<input class="J-line-input J-tag form-control" placeholder="请输入服饰标签" value="" onfocus="showTagList(this);" onblur="removeList();">
				<button type="button" class="J-line-input btn btn-info" onclick="addTag(this);" style="width:55px;">添加</button>
				<br />
			</div>
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-tag-list list-group"></ul>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>服饰轮播图片</label>
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
		<br />
		<div class="form-group">
			<button type="button" class="J-save-btn btn btn-primary" onclick="save(this);">保存服饰</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	var aDress = <?php echo json_encode($aDress); ?>;
	var aSizeColorList = <?php echo json_encode($aSizeColorList); ?>;
	var aTagList = <?php echo json_encode($aTagList); ?>;
	var oCurrentInputDom = {};
	
	function init(){
		if(typeof(aDress.dress_size_color_count) != 'undefined'){
			var oDom = $('.J-size-color-count');
			for(var i in aDress.dress_size_color_count){
				var aTemp = aDress.dress_size_color_count[i];
				var htmlStr = buildSCCHtml(aTemp.size_name, aTemp.color_name, aTemp.stock, aTemp.pic);
				var oTempDom = $(htmlStr);
				oDom.after(oTempDom);
				oDom.find('button').text('删除');
				oDom.find('button').attr('onclick', 'delSizeAndColorCount(this);');
				oDom = oTempDom;
			}
			$('.J-size-color-count')[0].remove();
		}else{
			$('.J-scc-pic').AjaxUpload({
				uploadUrl : '<?php echo Url::to(['dress-manage/upload-file']); ?>',
				fileKey : 'image',
				callback : function(aResult){
					if(aResult.status == 1){
						$('.J-scc-pic').attr('src', App.url.resource + aResult.data);
						$('.J-scc-pic').attr('data-pic', aResult.data);
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
				size : $('.J-size').val(), 
				color : $('.J-color').val(), 
				count : $('.J-count').val(),
				pic : $('.J-scc-pic').attr('data-pic')
			};
			aSizeColorCount.push(aTemp);
		}else{
			$('.J-size-color-count').each(function(){
				var aTemp = {
					size : $(this).find('.J-size').val(), 
					color : $(this).find('.J-color').val(), 
					count : $(this).find('.J-count').val(),
					pic : $(this).find('.J-scc-pic').attr('data-pic')
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

	function getPics(){
		var aPics = [];
		if($('.J-pics-list li').length == 0){
			UBox.show('请上传服饰轮播图片', -1);
			return false;
		}
		$('.J-pics-list li').each(function(){
			aPics.push($(this).attr('data-pic'));
		});
		
		return aPics;
	}

	function save(o){
		var id = $('.J-id').val();
		var name = $('.J-name').val();
		var catalogId = $('.J-catalog').val();
		var price = $('.J-price').val();
		var status = $('.J-status').val();
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
		var aPics = getPics();
		if(!aPics){
			return;
		}
		ajax({
			url : '<?php echo Url::to(['dress-manage/save']); ?>',
			data : {
				id : id,
				name : name,
				catalogId : catalogId,
				price : price,
				status : status,
				aSizeColorCount : aSizeColorCount,
				aTag : aTag,
				aPics : aPics
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
	
	function buildSCCHtml(size, color, count, img){
		var imgSrc = '';
		if(img != ''){
			imgSrc = App.url.resource + img;
		}
		var oDom = $('<div class="J-size-color-count form-group">\
				<input class="J-line-input J-size form-control" placeholder="请输入服饰尺码" value="' + size + '" onfocus="showSizeList(this);" onblur="removeList();">\
				<input class="J-line-input J-color form-control" placeholder="请输入服饰颜色" value="' + color + '" onfocus="showColorList(this);" onblur="removeList();">\
				<input class="J-line-input J-count form-control" placeholder="请输入服饰数量" value="' + count + '">\
				<img class="J-line-input J-scc-pic" data-pic="' + img + '" src="' + imgSrc + '" title="上传图片" onmouseover="showBigPic(this);" onmouseout="removeBigPic();" />\
				<button type="button" class="J-line-input btn btn-info" onclick="addSizeAndColorCount(this);" style="width:55px;">添加</button>\
				<br />\
			</div>\
		');
		
		oDom.find('img').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['dress-manage/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					oDom.find('img').attr('src', App.url.resource + aResult.data);
					oDom.find('img').attr('data-pic', aResult.data);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
		
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
		$(o).parent().after(buildSCCHtml('', '', '', ''));
		$(o).text('删除');
		$(o).attr('onclick', 'delSizeAndColorCount(this);');
	}
	
	function delSizeAndColorCount(o){
		$(o).parent().remove();
	}
	
	function addTag(o){
		var tag = $('.J-tag').val();
		if(tag == ''){
			UBox.show('标签不能为空', -1);
			return;
		}
		$('.J-tag-list').append(buildTagHtml(tag));
		$('.J-tag').val('');
	}
	
	function buildTagHtml(tag){
		return '<li class="list-group-item"><p><a>' + tag + '</a><i onclick="deleteTag(this);">&nbsp;&nbsp;×</i></p></li>';
	}
		
	function deleteTag(o){
		$(o).parent().parent().remove();
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
	
	$(function(){
		<?php if($aDress){ ?>
		$('.J-status').val(<?php echo $aDress['status']; ?>);
		<?php } ?>
		init();
		$('.J-add-pics-btn').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['dress-manage/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					addPic(aResult.data);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	});
</script>