<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
use yii\widgets\LinkPager;
$this->setTitle('用户管理');
?>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '用户列表',
				'url' => Url::to(['user-manage/show-list']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">用户列表</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form role="form" class="J-search-form form-horizontal" name="J-search-form">
			<div class="J-condition-line">
				<label class="control-label" style="float:left;">手机号</label>
				<div class="col-sm-2" style="width:130px;">
					<input type="text" class="J-user-id form-control" name="mobile" value="<?php echo $mobile ? $mobile : ''; ?>" />
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
					'id'	=>	['title' => '用户编号'],
					'name'	=>	['title' => '姓名'],
					'user_name'	=>	['title' => '用户名'],
					'gold'	=>	['title' => '金币数'],
					'email'	=>	['title' => '邮箱'],
					'mobile'	=>	['title' => '手机号'],
					'operate' => [
						'title' => '操作',
						'class' => 'col-sm-1',
						'content' => function($aData){
							return '<a href="javascript:;" onclick="showAddGold(this, ' . $aData['id'] . ');">添加金币</a>&nbsp;&nbsp;<a href="javascript:;" onclick="deleteItem(this, ' . $aData['id'] . ');">删除</a>';
						}
					],
				],
				'aDataList'	=>	$aUserList,
			]);
			echo LinkPager::widget(['pagination' => $oPage]);
		?>
	</div>
</div>
<script type="text/javascript">
	function search(){
		var condition = $('form[name=J-search-form]').serialize();
		location.href = '<?php echo Url::to(['user-manage/show-list']); ?>?' + condition;
	}
	
	function buildAddGoldHtml(o, id){
		var htmlStr = '';
		
		htmlStr += '\
			<div class="form-group">\
				<label>用户编号</label>\
				<input class="J-add-gold-user-id form-control" placeholder="请输入用户编号" value="' + id + '">\
			</div>\
			<div class="form-group">\
				<label>添加金币数量</label>\
				<input class="J-add-gold-num form-control" placeholder="请输入金币数量" value="">\
			</div>\
		';
		
		return htmlStr;
	}
	
	function showAddGold(o, id){
		$.teninedialog({
			title : '添加金币',
			content : buildAddGoldHtml(o, id),
			url : '',
			showCloseButton : false,
			otherButtons : ['添加'],
			otherButtonStyles : ['btn-primary'],
			bootstrapModalOption : {keyboard: true},
			dialogShow : function(){
				//alert('即将显示对话框');
			},
			dialogShown : function(){
				
			},
			dialogHide : function(){
				//alert('即将关闭对话框');
			},
			dialogHidden : function(){
				//alert('关闭对话框');
			},
			clickButton : function(sender, modal, index){
				var userId = $('.J-add-gold-user-id').val();
				var gold = $('.J-add-gold-num').val();
				
				if(userId == ''){
					UBox.show('请输入用户编号', -1);
					return;
				}
				if(gold == ''){
					UBox.show('请输入金币数量', -1);
					return;
				}
				
				ajax({
					url : '<?php echo Url::to(['user-manage/add-gold']); ?>',
					data : {
						userId : userId,
						gold : gold
					},
					success : function(aResult){
						UBox.show(aResult.msg, aResult.status);
						if(aResult.status == 1){
							location.reload();
						}
						$(this).closeDialog(modal);
					}
				});
			}
		});
	}
	
	function deleteItem(o, id){
		UBox.confirm('确定要删除？', function(){
			ajax({
				url : '<?php echo Url::to(['user-manage/delete']); ?>',
				data : {
					id : id
				},
				beforeSend : function(){
					$(o).attr('disabled', 'disabled');
				},
				complete : function(){
					$(o).attr('disabled', false);
				},
				success : function(aResult){
					if(aResult.status == 1){
						$(o).parent().parent().remove();
					}
					UBox.show(aResult.msg, aResult.status);
				}
			});
		});
		
	}
	$(function(){
		
	});
</script>