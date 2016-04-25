<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use umeworld\lib\Url;

\home\assets\CommonAsset::register($this);
//$this->registerAssetBundle('common\assets\UBoxAsset');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="bodyContainer">
        <?= $content ?>
    </div>
</div>

<footer class="footer">

</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
