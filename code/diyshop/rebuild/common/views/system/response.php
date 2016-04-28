<?php
use yii\helpers\Html;
$this->registerCssFile('@r.css.error');
$this->beginPage();
?>
<!doctype html>
<html>
<head>
<title>出错啦</title>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="format-detection"content="telephone=no">
<?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>
<div class="error-container">
	<div class="title">
		<h2><?php echo '提示'; ?></h2>
	</div>
	<div class="content">
		<h3><?php echo $msg; ?></h3>
	</div>
	<div class="redirect">
		<?php
			$referer = Yii::$app->request->headers->get('referer');
			if($referer){
				echo Html::a('回上一页', $referer);
			}
		?>
		<a href="<?php echo \umeworld\lib\Url::to(['site/index']); ?>">回到首页</a>
	</div>
</div>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>