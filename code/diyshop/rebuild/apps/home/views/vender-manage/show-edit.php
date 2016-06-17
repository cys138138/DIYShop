<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('商家管理');
$this->registerAssetBundle('common\assets\AjaxUploadAsset');
?>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '商家列表',
				'url' => Url::to(['vender-manage/show-list']),
			],
			[
				'title' => $aVender ? '编辑商家' : '添加商家',
				'url' => Url::to(['vender-manage/show-edit']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $aVender ? '编辑商家' : '添加商家'; ?></h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<input class="J-id form-control" type="hidden" value="<?php echo $aVender ? $aVender['id'] : ''; ?>">
			<label>用户名</label>
			<input class="J-user-name form-control" placeholder="请输入用户名" value="<?php echo $aVender ? $aVender['user_name'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<label>手机号码</label>
			<input class="J-mobile form-control" placeholder="请输入手机号码" value="<?php echo $aVender ? $aVender['mobile'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<label>邮箱</label>
			<input class="J-email form-control" placeholder="请输入邮箱" value="<?php echo $aVender ? $aVender['email'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<label>厂商名称</label>
			<input class="J-name form-control" placeholder="请输入厂商名称" value="<?php echo $aVender ? $aVender['name'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<label>公司码</label>
			<input class="J-company-code form-control" placeholder="请输入公司码" value="<?php echo $aVender ? $aVender['company_code'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<label>公司性质</label>
			<input class="J-company-property form-control" placeholder="请输入公司性质" value="<?php echo $aVender ? $aVender['company_property'] : ''; ?>">
			<br />
		</div>
		<div class="form-group">
			<label>公司地址</label>
			<textarea class="J-company-address form-control" rows="3" placeholder="请输入公司地址"><?php echo $aVender ? $aVender['company_address'] : ''; ?></textarea>
			<br />
		</div>
		<!--<div class="form-group">
			<label>服饰限制数量</label>
			<input class="J-dress-count-limit form-control" placeholder="请输服饰限制数量" value="<?php echo $aVender ? $aVender['dress_count_limit'] : 0; ?>">
			<br />
		</div>-->
		<div class="form-group" <?php echo $aVender ? 'style="display:none;"' : ''; ?>>
			<label>密码</label>
			<input class="J-password form-control" type="password" placeholder="请输入密码" value="">
			<br />
		</div>
		<div class="form-group" <?php echo $aVender ? 'style="display:none;"' : ''; ?>>
			<label>确认密码</label>
			<input class="J-en-password form-control" type="password" placeholder="再输入一次密码" value="">
			<br />
		</div>
		<br />
		<div class="form-group">
			<button type="button" class="J-save-btn btn btn-primary" onclick="save(this);">保存</button>
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
		var companyProperty = $('.J-company-property').val();
		var companyAddress = $('.J-company-address').val();
		//var dressCountLimit = $('.J-dress-count-limit').val();
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
			url : '<?php echo Url::to(['vender-manage/save']); ?>',
			data : {
				id : id,
				name : name,
				userName : userName,
				mobile : mobile,
				email : email,
				companyCode : companyCode,
				companyProperty : companyProperty,
				companyAddress : companyAddress,
				//dressCountLimit : dressCountLimit,
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
						location.href = '<?php echo Url::to(['vender-manage/show-list']); ?>';
					}, 3);
				}else{
					UBox.show(aResult.msg, aResult.status);
				}
			}
		});
	}
	$(function(){
		
	});
</script>