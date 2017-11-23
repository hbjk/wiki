<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= Html::encode($testone->name) ?> — 华本百科</title>
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link rel="stylesheet" type="text/css" href="/css/ydui.css">
    <link rel="stylesheet" type="text/css" href="/css/index.css">
</head>
<body>
    <section class="g-flexview" id="g-index">
        <header class="m-navbar">
            <a href="#" class="navbar-item"><i class="back-ico back-page"></i></a>
            <div class="navbar-center">
                <span class="navbar-title">
                    <svg class="icon nav-logo" aria-hidden="true">
                        <use xlink:href="#dicon-logo">
                    </svg>
                </span>
            </div>
        </header>
        <div class="g-scrollview">
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
                    <p><a href="<?php echo Url::to(['testen/pagen','id' => $data->id]);?>"> <?= Html::encode($data->name) ?> </a></p>
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
        </div>
    </section>

    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="/js/ydui.js"></script>
    <script type="text/javascript" src="/js/ydui.flexible.js"></script>
    <script type="text/javascript" src="/js/iconfont.js"></script>
    <script type="text/javascript">
        !function (win, $) {
            FastClick.attach(document.body);

            //later load
            $('img').lazyLoad();

            //back page
            $('.back-page').click(function(){
                window.history.back();
            });
        }(window, jQuery);
    </script>
</body>
</html>