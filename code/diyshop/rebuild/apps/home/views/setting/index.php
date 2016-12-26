<?php 
use umeworld\lib\Url;
use home\widgets\Table;
use home\widgets\ModuleNavi;
$this->setTitle('广告显示设置');
?>
<div class="row">
	<?php echo ModuleNavi::widget([
		'aMenus' => [
			[
				'title' => '广告显示设置',
				'url' => Url::to(['setting/index']),
				'active' => true,
			],
		],
	]); ?>
	<div class="col-lg-12">
		<h1 class="page-header">广告显示控制</h1>
		<div class="form-group">
			<label>是否显示广告</label>
			<label class="radio-inline">
				<input class="J-is-show-advertisement J-is-show-advertisement-yes" type="radio" name="is_show_advertisement" data-val="1">显示
			</label>
			<label class="radio-inline">
				<input class="J-is-show-advertisement J-is-show-advertisement-no" type="radio" name="is_show_advertisement" data-val="0">不显示
			</label>
		</div>
	</div>
</div>


<script type="text/javascript">
	var isShowAdvertisement = '<?php echo $isShowAdvertisement; ?>';
	function saveIsShowAdvertisement(){
		ajax({
			url : '<?php echo Url::to(['setting/save-is-show-advertisement']); ?>',
			data : {
				isShowAdvertisement : isShowAdvertisement
			},
			success : function(aResult){
				UBox.show(aResult.msg, aResult.status);
			}
		});
	}
	
	$(function(){
		if(isShowAdvertisement == 1){
			$('.J-is-show-advertisement-yes').attr('checked', true);
			$('.J-is-show-advertisement-no').removeAttr('checked');
		}else{
			$('.J-is-show-advertisement-no').attr('checked', true);
			$('.J-is-show-advertisement-yes').removeAttr('checked');
		}
		$('.J-is-show-advertisement').on('click', function(){
			isShowAdvertisement = $(this).attr('data-val');
			saveIsShowAdvertisement();
		});
	});
</script>