<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\AppAsset;

//load basic files
AppAsset::register($this);

//start
$this_js = <<<JS
!function (win, $) {
    //choose
    FastClick.attach(document.body);
    var dialog = win.YDUI.dialog;
}(window, jQuery);
JS;
$this->registerJs($this_js);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="UTF-8"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> — 华本百科</title>
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<section class="g-flexview" id="g-index">
    <header class="m-navbar">
        <a href="javascript:;" class="navbar-item back-page"><i class="back-ico"></i></a>
        <div class="navbar-center">
                <span class="navbar-title">
                    <svg class="icon nav-logo" aria-hidden="true">
                        <use xlink:href="#dicon-logo">
                    </svg>
                </span>
        </div>
    </header>
    <div class="g-scrollview">
        <?=$content?>
    </div>
</section>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>