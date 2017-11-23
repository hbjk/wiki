<?php

use yii\helpers\Html;
use yii\helpers\Url;


//load basic files
$this->registerCssFile('@web/css/index.css',['depends'=>['frontend\assets\AppAsset']]);
//solar css
$this->registerCssFile('@web/css/component.css',['depends'=>['frontend\assets\AppAsset']]);
//jq mobile
$this->registerJsFile('http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js',['depends'=>['frontend\assets\AppAsset']]);

//js
$this_js = <<<JS
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

    /*choose solar or time*/
    $('a.btn-block').click(function(){
        $(this).addClass('btn-choose');
        $(this).siblings('a').removeClass('btn-choose');
    });

    //move stop effect
    var size = parseInt($("html").css('font-size').substr(0, $("html").css('font-size').length - 2));
    $(document).on("scrollstop",function(){
        //specific move effect
        $('.cbp_tmtimeline li').each(function(){
          if($(this).offset().top-$(document).scrollTop() <= $(window).height()/4 && $(this).offset().top-$(document).scrollTop()+$(this).height() >= $(window).height()/4)
          {
            if($(this).find('.time-content').height() == 0)
            {
                //hide of content show
                var that = $(this);
                $(this).find('div.time-content').addClass('cont-show');
                //logo big
                $(this).find('div.circle').addClass('circle-big');
                $(this).find('i.iconfont-d').addClass('iconfont-big');

                //show of content hide
                $(this).siblings('li').each(function(){
                    if($(this).find('div.time-content').height() > 0)
                    {
                        var these = $(this);
                        //show of content hide
                        $(this).find('div.time-content').removeClass('cont-show');
                        //logo small
                        $(this).find('div.circle').removeClass('circle-big');
                        $(this).find('i.iconfont-d').removeClass('iconfont-big');

                        //position
                        if(that.index() > these.index())
                        {
                            $('body,html').animate({'scrollTop':$(window).scrollTop()-size*8},1000);
                        }
                    }
                });
            }
            return false;
          }
        });
    });
}(window, jQuery);
JS;
$this->registerJs($this_js);

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <?= Html::csrfMetaTags() ?>
        <title>华本百科</title>
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
            <article>
                <div class="main">
                    <div class="top-img">
                        <img src="/images/solar-day.png" />
                        <a href="#" class="btn-block btn-no-ch btn-choose">廿四节气</a>
                        <a href="#" class="btn-block left-half btn-no-ch">十二时辰</a>
                    </div>
                    <ul class="cbp_tmtimeline">
                        <li class="first-one">
                            <time class="cbp_tmtime" datetime="2013-04-10 18:30">
                            </time>
                            <div class="circle circle-first"></div>
                            <i class="icon iconfont-d fist-rounte">&#xe634;</i>
                            <div class="cbp_tmlabel">
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" datetime="2013-04-10 18:30">
                                <span>寒露</span>
                                <span>10月8-9日</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe649;</i>
                            <div class="cbp_tmlabel">
                                <h2>寒露阴阳身不懒，动静禅坐修内丹。晨早呼吸一声叹，吐故纳新赛神仙。</h2>
                                <div class="time-content cont-hide">
                                    <p>
                                        <span>食疗：</span>当归10克、党参10克、山药20克、猪腰500克、姜丝、蒜泥、香油、酱油等少许，蒸熟后服用。
                                    </p>
                                    <p>
                                        <span>经络：</span>用白酒将艾叶、姜捣烂外敷或拍打关节处，每天一次。拿捏肩颈、肩胛10分钟。
                                    </p>
                                    <p>
                                        <span>药茶：</span>羌活12克、独活12克、川芎8克、白芍12克、板蓝根12克、葛根12克、茯苓20克、甘草3克煎水服。
                                    </p>
                                    <p>
                                        <span>注意：</span>霜降小补、暖胃健脾、防燥解郁、养阴食酸、收敛阳气、动静适宜。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" datetime="2013-04-10 18:30">
                                <span>霜降</span>
                                <span>10月23-24日</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe648;</i>
                            <div class="cbp_tmlabel">
                                <h2>霜降体寒筋骨软，老寒瘀阻一大圈，早知病邪身不浅，养生健体重在肩。</h2>
                                <div class="time-content cont-hide">
                                    <p>
                                        <span>食疗：</span>当归10克、党参10克、山药20克、猪腰500克、姜丝、蒜泥、香油、酱油等少许，蒸熟后服用。
                                    </p>
                                    <p>
                                        <span>经络：</span>用白酒将艾叶、姜捣烂外敷或拍打关节处，每天一次。拿捏肩颈、肩胛10分钟。
                                    </p>
                                    <p>
                                        <span>药茶：</span>羌活12克、独活12克、川芎8克、白芍12克、板蓝根12克、葛根12克、茯苓20克、甘草3克煎水服。
                                    </p>
                                    <p>
                                        <span>注意：</span>霜降小补、暖胃健脾、防燥解郁、养阴食酸、收敛阳气、动静适宜。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" datetime="2013-04-10 18:30">
                                <span>立冬</span>
                                <span>11月7-8日</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe647;</i>
                            <div class="cbp_tmlabel">
                                <h2>立冬潜阳别乱想，阴盛阳虚要提防，贪吃贪睡是虚胖，忙里忙外神易伤。</h2>
                                <div class="time-content cont-hide">
                                    <p>
                                        <span>食疗：</span>当归10克、党参10克、山药20克、猪腰500克、姜丝、蒜泥、香油、酱油等少许，蒸熟后服用。
                                    </p>
                                    <p>
                                        <span>经络：</span>用白酒将艾叶、姜捣烂外敷或拍打关节处，每天一次。拿捏肩颈、肩胛10分钟。
                                    </p>
                                    <p>
                                        <span>药茶：</span>羌活12克、独活12克、川芎8克、白芍12克、板蓝根12克、葛根12克、茯苓20克、甘草3克煎水服。
                                    </p>
                                    <p>
                                        <span>注意：</span>霜降小补、暖胃健脾、防燥解郁、养阴食酸、收敛阳气、动静适宜。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" datetime="2013-04-10 18:30">
                                <span>小雪</span>
                                <span>11月22-23日</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe646;</i>
                            <div class="cbp_tmlabel">
                                <h2>小雪寒冷人足掌，内热口干在胸膛。咳喘呼吸缺点氧，头昏失眠太平常。</h2>
                                <div class="time-content cont-hide">
                                    <p>
                                        <span>食疗：</span>当归10克、党参10克、山药20克、猪腰500克、姜丝、蒜泥、香油、酱油等少许，蒸熟后服用。
                                    </p>
                                    <p>
                                        <span>经络：</span>用白酒将艾叶、姜捣烂外敷或拍打关节处，每天一次。拿捏肩颈、肩胛10分钟。
                                    </p>
                                    <p>
                                        <span>药茶：</span>羌活12克、独活12克、川芎8克、白芍12克、板蓝根12克、葛根12克、茯苓20克、甘草3克煎水服。
                                    </p>
                                    <p>
                                        <span>注意：</span>霜降小补、暖胃健脾、防燥解郁、养阴食酸、收敛阳气、动静适宜。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" datetime="2013-04-10 18:30">
                                <span>大雪</span>
                                <span>12月6-8日</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe645;</i>
                            <div class="cbp_tmlabel">
                                <h2>大雪来临身奇痒，血热内窜便秘肠。行走突然头在晃，小心中风身上降。</h2>
                                <div class="time-content cont-hide">
                                    <p>
                                        <span>食疗：</span>当归10克、党参10克、山药20克、猪腰500克、姜丝、蒜泥、香油、酱油等少许，蒸熟后服用。
                                    </p>
                                    <p>
                                        <span>经络：</span>用白酒将艾叶、姜捣烂外敷或拍打关节处，每天一次。拿捏肩颈、肩胛10分钟。
                                    </p>
                                    <p>
                                        <span>药茶：</span>羌活12克、独活12克、川芎8克、白芍12克、板蓝根12克、葛根12克、茯苓20克、甘草3克煎水服。
                                    </p>
                                    <p>
                                        <span>注意：</span>霜降小补、暖胃健脾、防燥解郁、养阴食酸、收敛阳气、动静适宜。
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </article>
            <aside class="ga-content">
            </aside>
        </div>
    </section>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>