<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use umeworld\lib\Url;

\common\assets\JQueryAsset::register($this);
\home\assets\CommonAsset::register($this);
\home\assets\CoreAsset::register($this);
\common\assets\BootstrapAsset::register($this);
\common\assets\UBoxAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?><?php $this->endBody() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php if(Yii::$app->controller->id == 'login'){ ?>
	<div id="page-wrapper">
		<?= $content ?>
	</div>
<?php }else{ ?>
	<div id="wrapper">
		<div class="container-fluid">
			<?php echo \home\widgets\Navi::widget(); ?>
		</div>
		<div id="page-wrapper">
			<?= $content ?>
		</div>
		<!-- /#page-wrapper -->
	</div>
<?php } ?>

<footer class="footer">

</footer>

<?php /*$this->endBody()*/ ?>
</body>
</html>
<?php $this->endPage() ?>
