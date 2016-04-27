<?php
use umeworld\lib\Url;

$_oApp = Yii::$app;

?>
<!--[if lt IE 8]>
<script type="text/javascript" src="<?php echo Yii::getAlias('@r.js.ie-tip')?>"></script>
<![endif]-->
<script type="text/javascript">
if(window.App && !App.inited){
	App.config({
		url : {
			resource : '<?php echo Yii::getAlias('@r.url'); ?>'
		},
		domain : '<?php echo $_oApp->domain; ?>'
	});

	App.bindEvent(App.EVENT_AFTER_AJAX_SUCCESS, function(oEvent){
		var aResult = oEvent.aResult;
		if(typeof(aResult.notice) != 'undefined'){
			if(typeof(aResult.notice.xxx) != 'undefined'){
				
			}
		}
	});
}

var oLog = null;
$(function(){
	if(window.Log){
		oLog = new Log();
	}
});
</script>
