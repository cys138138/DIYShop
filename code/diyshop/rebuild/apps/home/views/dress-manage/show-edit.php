<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('服饰管理');
$this->registerAssetBundle('common\assets\AjaxUploadAsset');
?>
<style type="text/css">
	.J-line-input{
		width: 130px;
		float:left;
		margin-right: 10px;
	} 
	.list-group-item{
		height:34px;
		float:left;
		line-height: 16px;
		margin:2px;
	}
	.list-group-item a{
		display:block;
		float:left;
		text-decoration:none;
	}
	.list-group-item i{
		float:left;
		display:block;
		cursor:pointer;
	}
	
	.J-pic-item{
		width:375px;
		height:298px;
		float:left;
		margin:2px;
	}
	.J-pic-item img{
		width:375px;
		height:234px;
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
			<label>尺码颜色库存</label>
		</div>
		<div class="J-size-color-count form-group">
			<input class="J-line-input J-size form-control" placeholder="请输入服饰尺码" value="">
			<input class="J-line-input J-color form-control" placeholder="请输入服饰颜色" value="">
			<input class="J-line-input J-count form-control" placeholder="请输入服饰数量" value="">
			<button type="button" class="J-line-input btn btn-info" onclick="addSizeAndColorCount(this);" style="width:55px;">添加</button>
			<br />
		</div>
		<div class="form-group" style="margin-top:45px;">
			<label>服饰标签</label>		
			<div class="form-group">
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
		<div class="form-group">
			<label>服饰轮播图片</label>
			<div class="form-group">
				<button type="button" class="J-add-pics-btn btn btn-primary">添加图片</button>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<ul class="J-pics-list list-group">
						<li class="list-group-item J-pic-item" data-pic="">
							<p><img class="img-thumbnail" src="" alt=""></p>
							<p><center><button type="button" class="btn btn-sm btn-danger" onclick="deletePic(this);">删除</button></center></p>
						</li>
					</ul>
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
	function save(o){
		var id = $('.J-id').val();
		var name = $('.J-name').val();
		var userName = $('.J-user-name').val();
		var mobile = $('.J-mobile').val();
		var email = $('.J-email').val();
		var companyCode = $('.J-company-code').val();
		var dressCountLimit = $('.J-dress-count-limit').val();
		var password = $('.J-password').val();
		var enPassword = $('.J-en-password').val();
		if(userName == ''){
			UBox.show('请填写用户名', -1);
			return;
		}
		if(password != enPassword){
			UBox.show('两次输入密码不一致', -1);
			return;
		}
		ajax({
			url : '<?php echo Url::to(['dress-manage/save']); ?>',
			data : {
				id : id,
				name : name,
				userName : userName,
				mobile : mobile,
				email : email,
				companyCode : companyCode,
				dressCountLimit : dressCountLimit,
				password : password
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
	
	function buildSCCHtml(size, color, count){
		return '\
			<div class="J-size-color-count form-group">\
				<input class="J-line-input J-size form-control" placeholder="请输入服饰尺码" value="' + size + '">\
				<input class="J-line-input J-color form-control" placeholder="请输入服饰颜色" value="' + color + '">\
				<input class="J-line-input J-count form-control" placeholder="请输入服饰数量" value="' + count + '">\
				<button type="button" class="J-line-input btn btn-info" onclick="addSizeAndColorCount(this);" style="width:55px;">添加</button>\
				<br />\
			</div>\
		';
	}
	
	function addSizeAndColorCount(o){
		$(o).parent().after(buildSCCHtml('', '', ''));
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
		$('.J-tag-list').append('<li class="list-group-item"><p><a>' + tag + '</a><i onclick="deleteTag(this);">&nbsp;&nbsp;×</i></p></li>');
		$('.J-tag').val('');
	}
		
	function deleteTag(o){
		$(o).parent().parent().remove();
	}
	
	$(function(){
		<?php if($aDress){ ?>
		$('.J-status').val(<?php echo $aDress['status']; ?>);
		<?php } ?>
		$('.J-add-pics-btn').AjaxUpload({
			uploadUrl : '<?php echo Url::to(['dress-manage/upload-file']); ?>',
			fileKey : 'image',
			callback : function(aResult){
				if(aResult.status == 1){
					
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	});
</script>