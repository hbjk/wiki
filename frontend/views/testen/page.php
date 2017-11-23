<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;

$this->title = $testone->name;
//load basic files 
$this->registerCssFile('@web/css/index.css',['depends'=>['frontend\assets\AppAsset']]);
$this->registerJsFile('@web/js/echo.min.js',['depends'=>['frontend\assets\AppAsset']]); 

//css
$this_css = <<<CSS
    .g-scrollview .ga-content img {
        width: 85%;
        margin: 0 auto;
        background: url(/images/loading.gif) 50% no-repeat;
    }
    body,html{
        height: auto;
    }
CSS;
$this->registerCss($this_css);

//js
$this_js = <<<JS

Echo.init({
    offset: 0,
    throttle: 0
});

!function (win, $) {
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
}(window, jQuery);
JS;
$this->registerJs($this_js);

?>

            <article class="ga-content">
                <h1 class="title"><?= Html::encode($testone->slug) ?></h1>
                <time class="c-low pd20">
                    <?= date('Y-m-d',Html::encode($testone->created_at)) ?>
                </time>
                <div class="ga-content-textarea">
                    <?= $testone->introduce ?>
                </div>
            </article>
            <aside class="ga-content">
                <div class="more-article">
                    <h3 class="title">更多热门文章，请戳：</h3>
                    <?php foreach ($testdatas as $data): ?>
                    <p><a href="<?php echo Url::to(['testen/page','id' => $data->id]);?>"> <?= Html::encode($data->name) ?> </a></p>
                    <?php endforeach; ?>
                </div>
                <div class="visitor">
                    <i class="icon-like-outline"></i><?= Html::encode($testone->views) ?>
                </div>
                <div class="watchs m-navbar cp-intd">
                    <p class="cp-title">文本内容授权自：</p>
                    <div class="cp-info-left">
                        <p class="cp-name">华本健康官方微信号</p>
                        <p class="kown-more">想了解更多医学信息<br />请长按右侧二维码关注我们</p>
                    </div>
                    <div class="cp-info-right">
                        <img class="logo" src="/images/weixin.png" />
                    </div>
                </div>
            </aside>