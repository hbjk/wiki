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

    //margin top
    $('.g-scrollview').css('marginTop',$('header').height());

    //back page
    var u = navigator.userAgent;
    $('.back-page').click(function(){
        if(!!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/) && /(Safari)/i.test(u)){
            javascript:window.location=document.referrer;
        }
        else
        {
            window.history.go(-1);
        }
    });
    
    //Preload animation over
    $('.single2').addClass('single2-none');
    var t=setTimeout("$('.single2').remove()",1000);
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
<div class="single2">
    <div class="mg-div">
    </div>
    <div class="spinner">
        <div class="spinner-container container1">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
            <div class="circle4"></div>
        </div>
        <div class="spinner-container container2">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
            <div class="circle4"></div>
        </div>
        <div class="spinner-container container3">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
            <div class="circle4"></div>
        </div>
    </div>
</div>
<section class="g-flexview" id="g-index">
        <header class="m-navbar navbar-fixed">
            <a href="javascript:;" class="navbar-item back-page"><i class="back-ico"></i></a>
            <div class="navbar-center">
            <span class="navbar-title">
                <svg class="icon nav-logo" aria-hidden="true">
                    <use xlink:href="#dicon-logo">
                </svg>
            </span>
            </div>
            <a href="javascript:;" class="navbar-item cont-sorts sort-hid" data-ydui-actionsheet="{target:'#actionSheet',closeElement:'#cancel'}"><i class="icon-type"></i></a>
        </header>
        <div class="g-scrollview">
            <?=$content?>
        </div>
    </section>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>