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
    <title>华本百科</title>
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link rel="stylesheet" type="text/css" href="/css/ydui.css">
    <link rel="stylesheet" type="text/css" href="/css/index.css">
</head>
<body>
    <section class="g-flexview" id="g-index">
        <header class="m-navbar" id="m-navbar-d">
            <div class="navbar-center">
                <span class="navbar-title">
                    <svg class="icon nav-logo" aria-hidden="true">
                        <use xlink:href="#dicon-logo">
                    </svg>
                </span>
            </div>
        </header>
        <div class="m-box">
            <ul class="tab-nav">
                <li class="tab-nav-item tab-active"><a href="javascript:;">西医</a></li>
                <li class="tab-nav-item"><a href="javascript:;">中医</a></li>
                <li class="tab-nav-item"><a href="javascript:;">养生</a></li>
            </ul>
        </div>
        <div class="m-tab m-tab-content g-scrollview-index">
            <div class="tab-panel">
                <div class="tab-panel-item tab-active">
                    <div class="m-grids-4">
                        <?php foreach ($testdatas as $data): ?>
                        <a href="<?php echo Url::to(['testen/pagen','id' => $data->id]);?>" class="grids-item">
                            <div class="grids-icon">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#dicon-<?= Html::encode($data->checkLogo->check_logo) ?>">
                                </svg>
                            </div>
                            <div class="grids-txt"><span><?= Html::encode($data->name) ?></span></div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="tab-panel-item">中医</div>
                <div class="tab-panel-item">养生</div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="/js/ydui.js"></script>
    <script type="text/javascript" src="/js/ydui.flexible.js"></script>
    <script type="text/javascript" src="/js/iconfont.js"></script>
    <script type="text/javascript">
        $(function(){
            var $tab = $('#g-index');
            $tab.tab({
                nav: '.tab-nav-item',
                panel: '.tab-panel-item',
                activeClass: 'tab-active'
            });
            $tab.find('.tab-nav-item').on('open.ydui.tab', function (e) {
                console.log('索引：%s - [%s]正在打开', e.index, $(this).text());
            });

            $tab.find('.tab-nav-item').on('opened.ydui.tab', function (e) {
                console.log('索引：%s - [%s]已经打开了', e.index, $(this).text());
            });
        });
    </script>
</body>
</html>