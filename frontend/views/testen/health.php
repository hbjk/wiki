<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
AppAsset::register($this);

$this->title = '养生-华本健康';

//self css
//AppAsset::addCss($this,'@web/css/health.css');

$this->registerJs("
!function (win, $) {
    //navigation
    $('#J_Tab').tab({
        nav: '.tab-nav-item',
        panel: '.tab-panel-item',
        activeClass: 'tab-active'
    });

    //later load
    $('img').lazyLoad();

    //default choose
    $('.tab-nav-item:first').addClass('tab-active');

}(window, jQuery);
");
?>
<div class="c-items pd-lr-45">
    <div class="m-cell">
        <div class="cell-item c-items-hd">
            <div class="cell-left items-title">节气养生</div>
            <!-- <div class="cell-right c-items-more">了解更多</div> -->
        </div>
        <div class="c-items-des">
            廿四节气专属养生    十二时辰对应经络
        </div>
        <div class="c-items-cover">
            <div class="coverimg-box" style="background-image: url('//lo.localhb.com/images/24-banner.png');"></div>
        </div>
    </div>
</div>
<?php foreach ($allarticles as $a => $allcrticle): ?>
<div class="c-items pd-lr-45">
    <div class="m-cell">
        <div class="cell-item c-items-hd">
            <div class="cell-left items-title"><?= Html::encode($a);?></div>
            <div class="cell-right c-items-more">了解更多</div>
        </div>

        <?php foreach ($allcrticle as $article): ?>
        <div class="list-item clearfix">
            <div class="list-item-cover l">
                <div class="shaolin-cover" style="background-image: url('http://hbpublic.yandumall.com/data/2017/1022/kK4SUuJqQJj1vXm1XkEnoc7D_FcSHLqk.jpg?imageView2/1/w/70/h/70');"></div>
            </div>
            <div class="list-item-content r">
                <div class="list-item-title clearfix">
                    <div class="title l">
                        <a href="<?php echo Url::to(['testen/page','id' => $article->id]);?>">
                            <?= Html::encode($article->name)?>
                        </a>
                    </div>
                    <div class="time l">
                        <?php
                        if($article->updated_at >= $timearr['beginToday'])
                        {
                            echo '今天';
                        }elseif($article->updated_at >= $timearr['beginYesterday'])
                        {
                            echo '昨天';
                        }
                        elseif($article->updated_at >= $timearr['beginweek'])
                        {
                            echo '一周内';
                        }
                        elseif($article->updated_at >= $timearr['beginmonth'])
                        {
                            echo '一月内';
                        }else
                        {
                            echo date('Y-m-d',$article->updated_at);
                        }
                        ?>
                    </div>
                    <a href="<?php echo Url::to(['testen/page','id' => $article->id]);?>" class="r detail">查看</a>
                </div>
                <div class="list-item-desc">
                    <a href="<?php echo Url::to(['testen/page','id' => $article->id]);?>">
                        <?=$article->slug?>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</div>
<?php endforeach; ?>