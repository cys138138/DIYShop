<?php 
use umeworld\lib\Url;
$this->setTitle('DiyShop商家登录');
?>
<style type="text/css">
	.form-body{
		width: 600px;
		margin:0 auto;
	}
</style>
<div class="mainOut">
	<form role="form">
		<center>
			<div class="panel-heading">
				<h1>DiyShop商家登录</h1>
			</div>
		</center>
		<br />
		<br />
		<div class="form-group form-body">
			<label>请输入账号</label>
			<input class="J-m-login-account form-control" name="loginAccount" placeholder="用户名或手机或邮箱">
			<br />
			<label>请输入账号密码</label>
			<input class="J-m-login-password form-control" type="password" name="loginPassowrd" placeholder="账号密码">
			<br />
			<button type="button" class="btn btn-lg btn-primary" onclick="venderLogin(this);">登录</button>
		</div>
	</form>
</div>

<script type="text/javascript">
	function venderLogin(o){
		var account = $('.J-m-login-account').val();
		var password = $('.J-m-login-password').val();
		ajax({
			url : '<?php echo Url::to(['login/vender-login']); ?>',
			data : {
				account : account,
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
						location.href = aResult.data;
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