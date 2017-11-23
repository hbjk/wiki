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
    $('.tabbar-txt').each(function(){
        if($(this).html() == $('.type-title').html())
        {
            $(this).parent().addClass('tabbar-active');
        }
        else
        {
            $(this).parent().addClass('btn-deny');
        }
    });
    $('.btn-deny').on('click', function () {
        if($(this).attr('href') == 'javascript:;')
        {
            dialog.notify('还未开放！', 4000);
        }
    });
}(window, jQuery);
JS;
$this->registerJs($this_js);
/* @var $this yii\web\View */
/* @var $content string 字符串 */
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<section class="g-flexview">
    <div class="g-scrollview g-view-index">
        <header class="m-grids-5 pd-lr-45">
            <div class="grids-item type-title"><?=$this->params['name']?></div>
            <span class="grids-item"></span>
            <span class="grids-item"></span>
            <span class="grids-item"></span>
            <span class="grids-item g-index-logo">
                <i class="iconfont-d dicon-logo"></i>
            </span>
        </header>
        <article>
            <?=$content?>
        </article>
    </div>
    <footer class="m-tabbar">
        <?php foreach ($this->params['sorts'] as $sort): ?>
            <a href="<?php if($sort->action != ''){echo Url::to([$sort->action,'id' => $sort->cid]);}else {echo 'javascript:;';} ?>" class="tabbar-item" >
                <span class="tabbar-icon">
                    <i class="<?php switch ($sort->cname)
                    {
                        case '西医':
                            echo 'iconfont-d dicon-westerndoctor';
                            break;
                        case '中医':
                            echo 'iconfont-d dicon-Chinesemedicalscie';
                            break;
                        case '养生':
                            echo 'icon-shield';
                            break;
                        case '外治法':
                            echo 'icon-feedback';
                            break;
                        default:
                            echo '';}
                    ?>">
                    </i>
                </span>
                <span class="tabbar-txt"><?= Html::encode($sort->cname) ?></span>
            </a>
        <?php endforeach; ?>
        <a href="javascript:;" class="tabbar-item btn-deny">
            <span class="tabbar-icon">
                <i class="icon-search"></i>
            </span>
            <span class="tabbar-txt btn-deny">搜索</span>
        </a>
    </footer>
</section>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>