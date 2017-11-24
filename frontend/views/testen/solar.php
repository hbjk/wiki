
<?php

use yii\helpers\Html;

//load basic files
$this->registerCssFile('@web/css/index.css',['depends'=>['frontend\assets\AppAsset']]);
//solar css
$this->registerCssFile('@web/css/component.css',['depends'=>['frontend\assets\AppAsset']]);
//jq mobile
$this->registerJsFile('https://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.js',['depends'=>['frontend\assets\AppAsset']]);
//Endless Scroll
$this->registerJsFile('@web/js/jquery.endless-scroll-1.3.js',['depends'=>['frontend\assets\AppAsset']]);

//js
$this_js = <<<JS

!function (win, $) {

    //mo ren time content show and hide
    $('.ten-cont p:not(:first-child)').hide();

    //12 times content show
    $('.actionsheet-item').on('tap',function(){
        var that = $(this);
        $('.ten-cont').each(function(){
            $(this).find('p').hide();
            $(this).find('p:eq('+that.index()+')').show();
        });
        $('.m-actionsheet').removeClass('actionsheet-toggle');
        $('.mask-black').remove();
    });

    //light or night
    var now = new Date();var hour = now.getHours();var month = now.getMonth();var day = now.getDate();
    (month == 11) ? month=0 : month=month+1;
    //hour=21; //test time
    if(hour < 18 && hour >= 6)
    {
        $('.tab-nav-item:first').on('tap',function(){
            //document top to zero
            $(window).scrollTop(0);

            //pic
            $('.top-img').attr('src','/images/solar-day.png');
            //sorts hide
            $('.cont-sorts').addClass('sort-hid');
        });
        $('.tab-nav-item:last').on('tap',function(){
            //document top to zero
            $(window).scrollTop(0);

            //pic
            $('.top-img').attr('src','/images/time-day.png');
            //sorts show
            $('.cont-sorts').removeClass('sort-hid');
        });

        //opacity
        $('.tab-nav').css('opacity','.8');
    }
    else
    {
        /*choose solar or time*/
        $('.tab-nav-item').addClass('tab-nav-item-an');
        $('.tab-nav-item:first').addClass('tab-active-an');
        $('.tab-nav-item:first').on('tap',function(){
            //document top to zero
            $(window).scrollTop(0);

            //pic
            $('.top-img').attr('src','/images/solar-night.png');
            $(this).addClass('tab-active-an');
            $(this).siblings('li').removeClass('tab-active-an');
            //sorts hide
            $('.cont-sorts').addClass('sort-hid');
        });
        $('.tab-nav-item:last').on('tap',function(){
            //document top to zero
            $(window).scrollTop(0);

            //pic
            $('.top-img').attr('src','/images/time-night.png');
            $(this).addClass('tab-active-an');
            $(this).siblings('li').removeClass('tab-active-an');
            //sorts show
            $('.cont-sorts').removeClass('sort-hid');
        });

        //opacity
        $('.tab-nav').css('opacity','.7');
        //backgroundcolor
        $('.g-scrollview').css('backgroundColor','#1c1c28');
        $('.icon').css('backgroundColor','#fff');
        $('.icon').css('color','#fff');
        $('.fist-rounte').css('color','#02091D');
        $('.circle').css('backgroundColor','#fff');
        $('.circle').css('box-shadow','0 0 0 0.1rem #ababab');
        $('.circle-opa').css('boxShadow','0 0 2rem #fff');
        $('.circle-first').css('boxShadow','0 0 0 0 #e0e0e0');
        $('.circle-large').css('boxShadow','0 0 0 0 #e0e0e0');

        //font size
        $('.cbp_tmtimeline').addClass('cbp_tmtimeline-an');
        $('.cbp_tmtime span').css('color','#fff');
        $('.cbp_tmlabel h2,.time-content p,.time-content p span').css('color',"#e2e2ea");

        //pic
        $('.top-img').attr('src','/images/solar-night.png');
    }

    //month and day select
    $('.main-day li:not(:first-child)').each(function(){
        // first solar
        var timearr = $(this).children('.cbp_tmtime').attr('data-month').split('-');
        if(timearr[0] == month)
        {
            //next solar
            var next_select = $(this).next();
            var next_time_arr = $(this).next().children('.cbp_tmtime').attr('data-month').split('-');
            // next next solar
            var an_next_select = $(this).next().next();
            var an_next_time_arr = $(this).next().next().children('.cbp_tmtime').attr('data-month').split('-');

            if(day <= timearr[2])
            {
                //move
                $(this).nextAll().insertAfter($(".main-day .cbp_tmtimeline li:eq(0)"));
                $(this).insertAfter($(".main-day .cbp_tmtimeline li:eq(0)"));
                //hide of content show
                $(this).find('div.time-content').fadeIn();
                //logo big
                $(this).find('div.circle').addClass('circle-big');
                $(this).find('i.icon').addClass('iconfont-big');
                //color
                if(hour >= 18 || hour < 6)
                {
                    $(this).find('i.icon').css('color','#02081e');
                }
                return false;
            }
            else if(day > timearr[2] && day <= next_time_arr[2])
            {
                //move
                next_select.nextAll().insertAfter($(".main-day .cbp_tmtimeline li:eq(0)"));
                next_select.insertAfter($(".main-day .cbp_tmtimeline li:eq(0)"));
                //hide of content show
                //console.log($(this).next().html());
                next_select.find('div.time-content').fadeIn();
                //logo big
                next_select.find('div.circle').addClass('circle-big');
                next_select.find('i.icon').addClass('iconfont-big');
                //color
                if(hour >= 18 || hour < 6)
                {
                    next_select.find('i.icon').css('color','#02081e');
                }
                return false;
            }
            else
            {
                //move
                an_next_select.nextAll().insertAfter($(".main-day .cbp_tmtimeline li:eq(0)"));
                an_next_select.insertAfter($(".main-day .cbp_tmtimeline li:eq(0)"));
                //hide of content show
                an_next_select.find('div.time-content').fadeIn();
                //logo big
                an_next_select.find('div.circle').addClass('circle-big');
                an_next_select.find('i.icon').addClass('iconfont-big');
                //color
                if(hour >= 18 || hour < 6)
                {
                    an_next_select.find('i.icon').css('color','#02081e');
                }
                return false;
            }
        }

    });

    //time select
    $('.main-hour .cbp_tmtime').each(function(){
        var timearr = $(this).attr('data-month').split('-');
        if(hour >= timearr[0] && hour <= timearr[1])
        {
            //move
            $(this).parent().nextAll().insertAfter($(".main-hour .cbp_tmtimeline li:eq(0)"));
            $(this).parent().insertAfter($(".main-hour .cbp_tmtimeline li:eq(0)"));
            //hide of content show
            $(this).parent().find('div.time-content').fadeIn();
            //logo big
            $(this).parent().find('div.circle').addClass('circle-big');
            $(this).parent().find('i.icon').addClass('iconfont-big');
            //color
            if(hour >= 18 || hour < 6)
            {
                $(this).parent().find('i.icon').css('color','#02081e');
            }
            return false;
        }
    });

    //Endless Scroll
    $(document).endlessScroll({
        bottomPixels: 450,
        fireDelay: 10,
        callback: function(){
            //24 solar
            var last_li = $("ul#list li:last");
            last_li.after(last_li.prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().clone(true));

            //12 time
            var last_li_two = $("ul#listwo li:last");
            last_li_two.after(last_li_two.prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().clone(true));
        }
    });

    //click effect
    $('.cbp_tmtimeline li').on('tap',function(){
        //specific move effect
        if($(this).find('.time-content').is(":hidden"))
        {
            //hide of content show
            $(this).find('div.time-content').fadeIn();
            //logo big
            $(this).find('div.circle').addClass('circle-big');
            $(this).find('i.icon').addClass('iconfont-big');
            //color
            if(hour >= 18 || hour < 6)
            {
                $(this).find('i.icon').css('color','#02081e');
            }
        }
        else
        {
            //show of content hide
            $(this).find('div.time-content').hide();
            //logo smaller
            $(this).find('div.circle').removeClass('circle-big');
            $(this).find('i.icon').removeClass('iconfont-big');
            //color
            if(hour >= 18 || hour < 6)
            {
                $(this).find('i.icon').css('color','#fff');
            }
        }
    });

    //move effect
    var narhei = $('.tab-nav').height();
    $(window).scroll(function() {
        if($(window).scrollTop() >= $('.tab-nav').offset().top)
        {
            $('.tab-nav').addClass('two-sort');
            $('.tab-nav').css('top',$('header').height());
            $('.tab-nav').css('width',$('.g-scrollview').width());
            $('.tab-nav').css('height',narhei);
        }
        if($(window).scrollTop() <= $('.top-img').offset().top + $('.top-img').height())
        {
            $('.tab-nav').removeClass('two-sort');
            $('.tab-nav').css('top','auto');
        }
    });
}(window, jQuery);
JS;
$this->registerJs($this_js);

?>

<div class="m-tab" data-ydui-tab>
    <div class="two-top">
        <ul class="tab-nav">
            <li class="tab-nav-item tab-active"><a href="javascript:;">廿四节气</a></li>
            <li class="tab-nav-item"><a href="javascript:;">十二时辰</a></li>
        </ul>
        <img class="top-img" src="/images/solar-day.png" />
    </div>
    <div class="tab-panel">
        <article>
            <div class="tab-panel-item tab-active">
                <section>
                <div>
                    <div class="main main-day">
                        <ul class="cbp_tmtimeline" id="list">
                            <li class="first-one">
                                <time></time>
                                <div class="circle circle-opa"></div>
                                <div class="circle circle-large"></div>
                                <div class="circle circle-first"></div>
                                <i class="icon iconfont-d fist-rounte">&#xe634;</i>
                                <div class="cbp_tmlabel">
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="1-5-7">
                                    <span>小寒</span>
                                    <span>1月5-7日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe643;</i>
                                <div class="cbp_tmlabel">
                                    <h2>小寒虚弱不说谎，硬拖身心颈腰僵。<br/>早晚艾姜把足烫，汤粥食养多扶阳。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>用鸡一只、龙眼肉30克、荔枝肉30克、黑枣30克、莲子30克、枸杞30克、冰糖30克、料酒、盐、葱、姜适量炖服。
                                        </p>
                                        <p>
                                            <span>经络：</span>伸筋草30克、老贯草30克、艾叶30克、干姜10克熬水泡澡10分钟以上。
                                        </p>
                                        <p>
                                            <span>药茶：</span>鸡血藤12克、川芎12克、丹参12克、三七12克、淫羊霍12克、金樱子30克、补骨脂20克煎水服用。
                                        </p>
                                        <p>
                                            <span>注意：</span>温补滋阴、忌暴饮食、起居宜适、出行保暖、以静为主、谨慎大补。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="1-20-21">
                                    <span>大寒</span>
                                    <span>1月20-21日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe642;</i>
                                <div class="cbp_tmlabel">
                                    <h2>大寒来临冷更长，防寒防冻防肤疮。<br/>内脏潜阳话少讲，挺胸淡定把头昂。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>海参30克、羊肉150克、葱、姜、盐少许，炖服即可。
                                        </p>
                                        <p>
                                            <span>经络：</span>刮背脊、胸胃、温灸腰背、肚脐丹田半小时以上。
                                        </p>
                                        <p>
                                            <span>药茶：</span>柴胡12克、桂枝12克、防风12克、恙活12克、独活12克、川芎12克、白芍12克、天麻12克、红花8克煎熬后服用。
                                        </p>
                                        <p>
                                            <span>注意：</span>身困潜伏、早睡晚起、益肾汤品、食适高热、有氧运动、暖汤暖酒。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="2-3-5">
                                    <span>立春</span>
                                    <span>2月3-5日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe659;</i>
                                <div class="cbp_tmlabel">
                                    <h2>立春升阳一声吼，心肾相交必回头。<br/>肝胃相合利足手，食养药调命不休。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>春笋250克、猪肝120克、大米250克，用文火煎熬两小时服用。
                                        </p>
                                        <p>
                                            <span>经络：</span>拍打肝胆经，从上至下，反复由轻叩到重叩。手指点揉风池、行间穴20次以上。
                                        </p>
                                        <p>
                                            <span>药茶：</span>菊花20克、桑叶10克、姜丝2克、枸杞、冰糖少许泡水服。
                                        </p>
                                        <p>
                                            <span>注意：</span>保暖防寒、情志开明、少盐清淡、户外活动、早睡早起、梳头百次。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="2-18-20">
                                    <span>雨水</span>
                                    <span>2月18-20日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe658;</i>
                                <div class="cbp_tmlabel">
                                    <h2>雨水防燥润止抖，防困收汗不外流。<br/>蓄气养阳日光秀，动静相宜两相优。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>莲子30克、瘦肉20克、枸杞10克、大米30克，用文火煎熬两小时服用。
                                        </p>
                                        <p>
                                            <span>经络：</span>用手掌贴于肚脐，左右揉动50次以上，艾灸手指点按足三里穴20次以上。
                                        </p>
                                        <p>
                                            <span>药茶：</span>荷叶10克、夏枯草20克、枸杞10克、花茶10克泡水服用。
                                        </p>
                                        <p>
                                            <span>注意：</span>运动适度、春悟通络、忌风避寒、生津止燥、心平气和、双掌搓腰。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="3-5-7">
                                    <span>惊蛰</span>
                                    <span>3月5-7日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe657;</i>
                                <div class="cbp_tmlabel">
                                    <h2>惊蛰身暖肺咳嗽，冬藏阳开行艾灸。<br/>健脾开胃壮阳酒，食好睡好不发愁。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>猪心1个、酸枣仁20克、茯苓20克、远志10克、盐少许炖服。
                                        </p>
                                        <p>
                                            <span>经络：</span>叩打头部，由内侧向后轻微指叩到重叩半握拳敲打，每次10分钟以上。点揉三阴交穴5分钟以上。
                                        </p>
                                        <p>
                                            <span>药茶：</span>夜交藤10克、大枣10克、山楂20克、蜂蜜少许熬后服用。
                                        </p>
                                        <p>
                                            <span>注意：</span>少酸增甘、清淡消火、动静相宜、保肝息怒、滋阴润燥、贴脐常揉。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="3-20-21">
                                    <span>春分</span>
                                    <span>3月20-21日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe656;</i>
                                <div class="cbp_tmlabel">
                                    <h2>春分防风邪驱走，萌动阳刚雄赳赳。<br/>丹田元阳不外漏，吐纳呼吸在咽喉。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>鲜猪肝150克、枸杞30克、鸡蛋2枚、生姜、盐少许炖汤服。
                                        </p>
                                        <p>
                                            <span>经络：</span>用身体撞击墙柱，让背部脊柱两侧受力分别20次以上，点揉百会穴5分钟以上。
                                        </p>
                                        <p>
                                            <span>药茶：</span>板蓝根30克、防风10克、薄荷10克、荆芥10克泡水饮用。
                                        </p>
                                        <p>
                                            <span>注意：</span>阴阳平衡、空气新鲜、春困早眠、适度运动、春游避风、双掌搓脸。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="4-4-6">
                                    <span>清明</span>
                                    <span>4月4-6日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe655;</i>
                                <div class="cbp_tmlabel">
                                    <h2>清明五脏内相扣，情志善孝两厢柔。<br/>强身壮体默心咒，天人合一命双修。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>麦门冬30克、粳米50克、红枣20克、白糖少许，熬粥服。
                                        </p>
                                        <p>
                                            <span>经络：</span>用手掌摩揉两助各20下，由上往下压摩推。点揉合谷穴5分钟。
                                        </p>
                                        <p>
                                            <span>药茶：</span>石斛10克、杭菊20克、草决明10克、荞麦10克泡水服。
                                        </p>
                                        <p>
                                            <span>注意：</span>登高望远、深思静养、踏青郊外、微汗即止、素食简单、闭目内服。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="4-19-21">
                                    <span>谷雨</span>
                                    <span>4月19-21日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe654;</i>
                                <div class="cbp_tmlabel">
                                    <h2>谷雨体寒转湿透，六淫外侵笑风流。<br/>伤神苦思常自救，养阴冥静不思愁。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>清明菜100克、面粉200克、白糖少许混合成饼，并放入锅中蒸后炸食。
                                        </p>
                                        <p>
                                            <span>经络：</span>早晚烫足，在药水中放姜、艾叶、盐少许，每次15分钟以上。
                                        </p>
                                        <p>
                                            <span>药茶：</span>陈皮30克、莱菔子10克、葎草30克熬后服用。
                                        </p>
                                        <p>
                                            <span>注意：</span>暖凉自调、寒热有度、顺应季节、合理饮食、调畅情志、呼吸吐纳。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="5-5-7">
                                    <span>立夏</span>
                                    <span>5月5-7日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe653;</i>
                                <div class="cbp_tmlabel">
                                    <h2>立夏滋阴用得巧，汤养粥品细久熬。<br/>养生绝活有一招，心安平凡就自豪。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>桑葚100克、枇杷100克、枸杞20克、冰糖少许打汁后服用。
                                        </p>
                                        <p>
                                            <span>经络：</span>背部脊椎叩打，按摩半小时以上，拿捏肩井部20次。
                                        </p>
                                        <p>
                                            <span>药茶：</span>姜丝5克、山楂30克、黄芪20克、枸杞10克、红糖20克泡水服。
                                        </p>
                                        <p>
                                            <span>注意：</span>平心静气、宜酸减苦、调养胃气、笑口常开、早睡早起、搓揉手心。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="5-20-22">
                                    <span>小满</span>
                                    <span>5月20-22日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe652;</i>
                                <div class="cbp_tmlabel">
                                    <h2>小满寒湿体内找，湿热经络聚三焦，<br/>通腑利脏辨便尿，粗粮精细看咀嚼。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>薏苡仁100克、绿豆100克、大米150克熬粥服用。
                                        </p>
                                        <p>
                                            <span>经络：</span>用双手擦揉手足四肢，反复20次此上，并擦揉手心、足心处。
                                        </p>
                                        <p>
                                            <span>药茶：</span>荷叶5克、山楂10克、陈皮5克、姜丝2克煎熬后当茶饮用。
                                        </p>
                                        <p>
                                            <span>注意：</span>忌贪凉卧、慎生冷食、少吃肥腻、适量辛辣、健脾祛湿、按揉三里。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="6-5-7">
                                    <span>芒种</span>
                                    <span>6月5-7日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe651;</i>
                                <div class="cbp_tmlabel">
                                    <h2>芒种闲来无烦恼，阴阳平衡善治疗。<br/>排毒泻火体就好，正气一身护胸腰。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>紫菜30克、绿豆100克、排骨2斤、姜、花椒少许炖汤服。
                                        </p>
                                        <p>
                                            <span>经络：</span>用双手贴于胸胃处，按揉30以上，两手指掐揉内、外关10次以上。
                                        </p>
                                        <p>
                                            <span>药茶：</span>夏枯草30克、龙胆草20克、苦丁茶10苦、苦瓜5克泡水服。
                                        </p>
                                        <p>
                                            <span>注意：</span>祛暑益气、生津止渴、少甜少咸、避免贪凉、食粥饮酸、内吞津液。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="6-21-22">
                                    <span>夏至</span>
                                    <span>6月21-22日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe653;</i>
                                <div class="cbp_tmlabel">
                                    <h2>夏至口干津液少，止言常静少辣椒。<br/>纳凉避热忌取巧，好粥度夏要久熬。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>先马齿苋300克、姜、盐、醋、色拉油、大蒜少许凉拌饮用。
                                        </p>
                                        <p>
                                            <span>经络：</span>大椎、肚脐、八髎等处，拔罐10分钟即可，掌揉前额印堂20次以上。
                                        </p>
                                        <p>
                                            <span>药茶：</span>西瓜300克、苦瓜100克、桃子100克、莲藕100克打成汁饮用。
                                        </p>
                                        <p>
                                            <span>注意：</span>心静体闲、藏阴降温、中午小睡、忌外暴晒、防暑饮水、丹田内守。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="7-6-8">
                                    <span>小暑</span>
                                    <span>7月6-8日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe64f;</i>
                                <div class="cbp_tmlabel">
                                    <h2>小暑退热冲凉澡，西瓜苦茶食良糕。<br/>心烦不要与人吵，安神深睡看情操。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>鲜玉竹60克、粳米60克，冰糖适量用文火熬服。
                                        </p>
                                        <p>
                                            <span>经络：</span>将薄荷叶、桑叶、夏枯茶、苦瓜叶、黄莲也煎水外洗全身，并拍打四肢关节。
                                        </p>
                                        <p>
                                            <span>药茶：</span>乌梅20克、苦丁茶30克、山楂30克、黄芪30克、西洋参5克煎水服。
                                        </p>
                                        <p>
                                            <span>注意：</span>静气养心、清淡饮食、防暑少汗、纳凉适中、喝蔬菜汤、轻揉人中。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="7-22-24">
                                    <span>大暑</span>
                                    <span>7月22-24日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe64e;</i>
                                <div class="cbp_tmlabel">
                                    <h2>大暑虚脱汗洗澡，止泻肠胃要常调。<br/>中暑人中防昏倒，内服治本也治标。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>薏米30克、赤小豆30克、山药30克、大米100克熬粥服用。
                                        </p>
                                        <p>
                                            <span>经络：</span>丝瓜络20克、薄荷叶30克、苦瓜30克、苦丁茶20克熬水后，用毛巾浸后外擦头、面、四肢。
                                        </p>
                                        <p>
                                            <span>药茶：</span>橘皮20克、香薷10克、陈皮20克、薄荷5克熬水服。
                                        </p>
                                        <p>
                                            <span>注意：</span>择阴纳凉、避热伤身、头晕该静、忌体劳累、防暑降温、急救内关。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="8-7-9">
                                    <span>立秋</span>
                                    <span>8月7-9日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe64d;</i>
                                <div class="cbp_tmlabel">
                                    <h2>立秋消暑走不远，热毒浸身筋骨酸。<br/>通利二便身康健，止汗止泻润升咽。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>百合30克、莲子30克、瘦肉200克、枸杞10克熬汤服。
                                        </p>
                                        <p>
                                            <span>经络：</span>将双手举过头挺胸深呼吸，然后用左手按压右手由外侧推下内侧回转，反复十次以上。点揉胸部中府云门处。
                                        </p>
                                        <p>
                                            <span>药茶：</span>百部20克、陈皮30克、枇杷30克、知母20克、枳实10克煎熬后加蜂蜜当茶饮。
                                        </p>
                                        <p>
                                            <span>注意：</span>祛暑清热、滋阴润肺、调理脾胃、谨防秋燥、减少纳凉、活动筋骨。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="8-22-24">
                                    <span>处暑</span>
                                    <span>8月22-24日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe64c;</i>
                                <div class="cbp_tmlabel">
                                    <h2>处暑忌凉莫生怒，事烦内燥心要欢。<br/>七情六淫是风险，食养药调也简单。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>银耳30克、桔饼2个、枸杞10克、冰糖少许熬制成羹服用。
                                        </p>
                                        <p>
                                            <span>经络：</span>用双手叠压，推揉脘腹部，由上往下反复推揉50次以上，点按长强穴10次。
                                        </p>
                                        <p>
                                            <span>药茶：</span>三棱12克、莪术12克、白术12克、葛根12克、茯苓30克、鸡矢藤30克、莱菔子30克、葎草30克煎熬水服用。
                                        </p>
                                        <p>
                                            <span>注意：</span>清热安神、多睡午觉、秋冻敛阳、通风良好、护脐潜阳、常揉涌泉。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="9-7-9">
                                    <span>白露</span>
                                    <span>9月7-9日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe64b;</i>
                                <div class="cbp_tmlabel">
                                    <h2>白露下寒上热脸，寒热相兼易喉咽。<br/>久病体虚注意点，利湿补虚消瘀痰。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>山药200克、番茄100克、排骨1000克、姜丝、盐、花椒少许，煲汤服。
                                        </p>
                                        <p>
                                            <span>经络：</span>背部捏脊20次以上，常揉肚脐50次以上，艾灸足三里10分钟以上。
                                        </p>
                                        <p>
                                            <span>药茶：</span>柴胡12克、桂枝12克、防风12克、黄芪20克、沙参30克、山药30克、茯苓30克、甘草3克熬后调蜜服用。
                                        </p>
                                        <p>
                                            <span>注意：</span>昼夜温差、霜降防凉、夜寒日热、防寒脾胃、谨防秋燥、通力二便。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="9-22-24">
                                    <span>秋分</span>
                                    <span>9月22-24日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe64a;</i>
                                <div class="cbp_tmlabel">
                                    <h2>秋分寒邪足底卷，肺胃两寒头晕癫。<br/>关节不利还不算，秋痢咳喘闹翻天。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>鲜玫瑰花100克、面粉500克、葡萄干30克、乌梅30克、山楂30克、白糖200克，做成饼或糕服用。
                                        </p>
                                        <p>
                                            <span>经络：</span>用手指梳理头部各经各穴半小时，点按手三里、足三里等穴10分钟。
                                        </p>
                                        <p>
                                            <span>药茶：</span>木瓜10克、丹参5克、三七5克、山楂20克煎熬后甜蜜服用。
                                        </p>
                                        <p>
                                            <span>注意：</span>秋寒早防、润喉通窍、适度运动、防燥护肤、阴平阳秘、忌辣油腻。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="10-8-9">
                                    <span>寒露</span>
                                    <span>10月8-9日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe649;</i>
                                <div class="cbp_tmlabel">
                                    <h2>寒露阴阳身不懒，动静禅坐修内丹。<br/>晨早呼吸一声叹，吐故纳新赛神仙。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>雪梨6个、川贝20克、陈皮10克、冰糖少许、煎熬成膏服用。
                                        </p>
                                        <p>
                                            <span>经络：</span>用老姜沾白酒刮背、胸背成紫色瘀斑为宜，然后温灸10分钟即可。
                                        </p>
                                        <p>
                                            <span>药茶：</span>柴胡12克、桂皮12克、麻黄根12克、滑石12克、板蓝根20克、百部12克、知母12克、甘草8克煎后服用。
                                        </p>
                                        <p>
                                            <span>注意：</span>保暖足部、忌食凉饮、润肺生津、健脾适中、清热少用、运动全身。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="10-23-24">
                                    <span>霜降</span>
                                    <span>10月23-24日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe648;</i>
                                <div class="cbp_tmlabel">
                                    <h2>霜降体寒筋骨软，老寒瘀阻一大圈。<br/>早知病邪身不浅，养生健体重在肩。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>当归10克、党参10克、山药20克、猪腰500克、姜丝、蒜泥、香油、酱油等少许，蒸熟后服用。
                                        </p>
                                        <p>
                                            <span>经络：</span>用白酒将艾叶、姜捣烂外敷或拍打关节处，每天一次。拿捏肩井、肩胛10分钟。
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
                                <time class="cbp_tmtime" data-month="11-7-8">
                                    <span>立冬</span>
                                    <span>11月7-8日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe647;</i>
                                <div class="cbp_tmlabel">
                                    <h2>立冬潜阳别乱想，阴盛阳虚要提防。<br/>贪吃贪睡是虚胖，忙里忙外神易伤。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>肉苁蓉30克、羊肉200克、大米适量、食盐、姜丝少许熬粥服用。
                                        </p>
                                        <p>
                                            <span>经络：</span>用艾叶、老姜、花椒、盐等少许熬水后，烫洗双足，每天早晚各半小时以上。
                                        </p>
                                        <p>
                                            <span>药茶：</span>桂枝12克、防风12克、川牛膝20克、伸筋草20克、干姜12克、艾叶12克、石菖蒲12克、甘草3克煎水服。
                                        </p>
                                        <p>
                                            <span>注意：</span>万物收藏、忌食寒凉、适量运动、食偏燥热、早睡晚起、阳气潜藏。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="11-22-23">
                                    <span>小雪</span>
                                    <span>11月22-23日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe646;</i>
                                <div class="cbp_tmlabel">
                                    <h2>小雪寒冷人足寒，内热口干在胸膛。<br/>咳喘呼吸缺点氧，头昏失眠太平常。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>鱼头2斤、萝卜2斤、姜20克熬炖服用。
                                        </p>
                                        <p>
                                            <span>经络：</span>沐浴后用白酒浸姜丝、艾叶、羌活粉、三七粉外用擦洗或熏蒸洗即可。
                                        </p>
                                        <p>
                                            <span>药茶：</span>丹参1斤、三七半斤、山楂2斤打成粉每次3-5克在我服用。
                                        </p>
                                        <p>
                                            <span>注意：</span>阴冷晦暗、阴盛阳衰、食偏高热、肥甘味厚、保暖头颈、多食热粥。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="12-6-8">
                                    <span>大雪</span>
                                    <span>12月6-8日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe645;</i>
                                <div class="cbp_tmlabel">
                                    <h2>大雪来临身奇痒，血热内窜便秘肠。<br/>行走突然头再晃，小心中风身上降。</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>银耳20克、百合10克、雪梨1个、红桔1个、冰糖适量蒸服。
                                        </p>
                                        <p>
                                            <span>经络：</span>用刮瘀板刮肩井、背、胸痛处。并用艾灸患处。
                                        </p>
                                        <p>
                                            <span>药茶：</span>艾叶20克、威灵仙12克、山楂20克、干姜12克、红糖100克熬水服用。
                                        </p>
                                        <p>
                                            <span>注意：</span>滋补养阴、润燥补血、食补开胃、静以养阳、顺以天时、补肾擦足。
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <time class="cbp_tmtime" data-month="12-21-23">
                                    <span>冬至</span>
                                    <span>12月21-23日</span>
                                </time>
                                <div class="circle"></div>
                                <i class="icon iconfont-d">&#xe644;</i>
                                <div class="cbp_tmlabel">
                                    <h2>冬至羊肉汤尽享，固阳防寒自愈忙。<br/>冬练三九动内藏，寒风出汗身自强，</h2>
                                    <div class="time-content">
                                        <p>
                                            <span>食疗：</span>制附片10克、白萝卜2斤、羊肉2斤、姜、料酒、盐少许炖服。
                                        </p>
                                        <p>
                                            <span>经络：</span>背部、肚脐、腰部拔罐10分钟并用温灸半小时以上，百会穴点揉灸。
                                        </p>
                                        <p>
                                            <span>药茶：</span>龙眼肉10克、山药30克、莲肉15克、大枣10克、姜丝5克、粳米150克，熬粥服用。
                                        </p>
                                        <p>
                                            <span>注意：</span>审慎调食、起居有常、不忘劳作、养其精髓、冬至阳生、静待其变。
                                        </p>
                                    </div>
                                </div>
                            </li>
                    </ul>
                    </div>
                </div>
            </section>
            </div>
            <div class="tab-panel-item">
                <div class="main main-hour">
                    <ul class="cbp_tmtimeline" id="listwo">
                        <li class="first-one">
                            <time></time>
                            <div class="circle circle-opa"></div>
                            <div class="circle circle-large"></div>
                            <div class="circle circle-first"></div>
                            <i class="icon iconfont-d fist-rounte">&#xe634;</i>
                            <div class="cbp_tmlabel">
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" data-month="23-24">
                                <span>子时</span>
                                <span>23时-1时</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe636;</i>
                            <div class="cbp_tmlabel">
                                <h2>肝经</h2>
                                <div class="time-content ten-cont">
                                    <p>
                                        <span>常规：</span>当前胆经最旺。养生学认为：“肝之余气，泄于胆，聚而成精。胆为中正之官，五脏六腑取决于胆。气以壮胆，邪不能侵。胆气虚则怯，气短，谋略而不能决断。”胆汁需要新陈代谢。人在子时前入睡，胆方能完成代谢。“胆有多清，脑有多清。”凡在子时前入睡者，晨醒后头脑清醒，气色红润。反之，气色青白。
                                    </p>
                                    <p>
                                        <span>老年养生：</span>老年人已经进入浅睡阶段，易醒。绝大多数器官处于一天中工作最慢的状态，肝脏却在紧张工作，生血气为人体排毒。
                                    </p>
                                    <p>
                                        <span>不通症状：</span>胆经不通的表现为：口干口苦偏头痛容易惊悸；善叹息便溏便秘皮肤萎黄；消化不良关节痛脂肪瘤；痰湿结节积聚。有膝关节及下肢病，胃胀，胸胀，晨起口苦，失眠，多梦，易头疼，两侧痛，颈项不适等。
                                    </p>
                                    <p>
                                        <span>糖尿病：</span>糖尿病患者这个时间段的休息至关重要，如果你看到此消息请立刻停止一切工作，开始睡觉。可以采取按摩脚底的方法，不要太用力，配合呼吸，慢慢放松，闭上双眼，深吸一口气，然后缓缓的吐出。
                                    </p>
                                    <p>
                                        <span>痛风：</span>痛风病患者此时要熟睡，“三分治，七分养”，一定要保证每天8小时的睡眠，胆经当行的时候，全身都在修复，储备能量，对身体至关重要。
                                    </p>
                                    <p>
                                        <span>减肥：</span>一般来说，减肥是不会影响睡眠的。减肥期间睡眠变差，要从以下方面找原因。1.吃了含有违禁成分的减肥药；2.运动时间过长，强度过大；3.饮食过少；判断饮食是否适量的简单方法是入睡前应该没有饱腹感，而早上起床时肚子又有轻微的饥饿感。
                                    </p>
                                    <p>
                                        <span>感冒：</span>很多感冒症状是晚上比白天要严重，这是因为感冒属于外邪侵入，而白天阳气足，晚上阴气盛，此时正是一天中阴阳转换的时段，所以现在很多人会咳嗽，头痛的更厉害，极大影响睡眠。这里建议咳嗽不止者，可把枕头垫在背部，使头部居下，腹部居上，这时候痰液向下流，进入口腔，能避免痰液进入气管引起咳嗽；家里有加湿器的可以打开，以提高室内空气湿度，对缓解嗓子疼有一定作用，另外要多喝热水，多上厕所，以加快代谢，排除内邪。
                                    </p>
                                    <p>
                                        <span>腰间盘突出：</span>此时正是大自然阴阳交替之际，腰突者易犯病，发作时最理想的处理方式就是卧床，服用医嘱药物，但是若出现了腿无力，大小便失禁的情况，应当尽快到医院就诊。睡不着检查一下你的睡姿吧，最好是仰卧和侧卧，仰卧时在双下肢下面垫一软枕，以便双髋及双膝微屈，全身肌肉放松，椎间盘压力降低，减下椎间盘后突的倾向。腰突是慢性病，目前尚无有效的治疗方法，需要我们坚持调理和保持良好的作息才能好转。
                                    </p>
                                    <p>
                                        <span>痛经：</span>此时是一天中阴气的鼎盛期，痛经者可能会因疼痛而失眠，特别提醒，不要捶打腰部，因为腰酸疼痛是由于盆腔充血引起的，这样会导致盆腔更加充血，反而加剧酸胀感。痛经时的正确做法：跪在床上，抬高臀部，保持这种头低臀高的姿势能改善子宫的后倾位置，此法可解除盆腔淤血，减轻疼痛，很好用。
                                    </p>
                                    <p>
                                        <span>脑血栓：</span>子时是脑血栓的高发期，此时段发病原因大多是由于进入睡眠后血压过低，导致血粘度增加造成的；如出现严重不适，应立即解开衣领，平躺，将头侧向另一边，减少肢体活动，保持心情平稳，及时就医；发病患者中，50%有先兆症状，信号一般是剧烈的头疼，脑血栓并不可怕，只要坚持合理的饮食和作息，我们一定会战胜它。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" data-month="1-2">
                                <span>丑时</span>
                                <span>1时-3时</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe637;</i>
                            <div class="cbp_tmlabel">
                                <h2>肝经</h2>
                                <div class="time-content ten-cont">
                                    <p>
                                        <span>常规：</span>此时肝经最旺。“肝脏血”人的思维行动要靠肝血支持，废旧的血压淘汰，新鲜的血液产生，这种新陈代谢通常在肝经最旺的丑时完成。养生学认为：“人卧则血归于肝。”如果丑时不睡，肝还在输出能量，就无法完成新陈代谢。此时肺经最旺。“肺朝百脉。”肝于丑时推陈出新，将新鲜的血液送往全身。所以人在清晨面色红润，精力充沛。
                                    </p>
                                    <p>
                                        <span>老年养生：</span>老年人此时肌肉完全放松。由于身体较弱，所以全靠这个时段来恢复一天的消耗，千万不可熬夜，实在睡不着可以用大拇指按摩脚底涌泉穴5-10分钟，对失眠会有缓解作用。
                                    </p>
                                    <p>
                                        <span>不通症状：</span>肝经不通的表现为：口干口苦情志抑郁胸胁胀痛；眩晕血压不稳易怒冲动；皮肤萎黄易倦乏力前列腺肥大；月经不调乳房疾病小便黄。有黑眼圈、目倦神疲、眼睛干涩、视物模糊、迎风流泪、眩晕、面色白、性冷淡、下肢无力、易倦、易惊恐等。
                                    </p>
                                    <p>
                                        <span>糖尿病：</span>糖尿病患者夜间低血糖是引起失眠的一个主要原因，建议测一下血糖根据情况治疗，另外个人生活习惯不好、更年期、饱食、甲状腺功能偏低额人，也会导致睡眠障碍。这个情况可以适当的听一些轻音乐，在睡前喝杯热牛奶，保持身心愉悦，不要怕糖尿病，好好调养它并不可怕。
                                    </p>
                                    <p>
                                        <span>痛风：</span>痛风病患者的失眠，可以用掌根从大腿根部推至膝盖处，也可握拳后，用四指的第二个关节向下推，这是疏通肝经的方法。此时正是养肝血的最佳时间，不睡觉就养不了肝血，从而减弱肝的排毒能力，间接加重痛风病情。
                                    </p>
                                    <p>
                                        <span>减肥：</span>按摩带脉穴可减肥，位于人体侧腹部，当第11肋骨游离端下方垂线与脐水平线的交点上，肝经章门穴下1.8寸处。与肚脐同高度，腹洁穴，位于顺乳头线往下，比肚脐低3厘米处的位置。用双手从两边按捏、揉点、提拿穴位。经过长时间的按摩，穴位也会逐渐被打开。沿着带脉横向敲击30-50圈，重点在带脉穴上敲击50-100下，对于恢复带脉的约束能力，减除腰腹部的脂肪，作用是无与伦比的。
                                    </p>
                                    <p>
                                        <span>感冒：</span>按摩环跳穴可治感冒，位于人体的股外侧部，侧卧屈股，当股骨大转子最凸点与骶管裂孔连接的外三分之一与中三分之一交点处。两手握拳，手心向内，两拳同时捶打两侧环跳穴50下或者两手抱两膝搂怀后再伸直，以此反复，一伸一屈共做50下。
                                    </p>
                                    <p>
                                        <span>腰间盘突出：</span>按摩昆仑穴可治腰间盘突出，昆仑穴位于脚踝外侧，在外踝顶点于脚跟相连接的中央点（足外踝后方，当外踝尖与跟腱之间的凹陷处）。先将肌肉放松，一边缓缓吐气一边强压昆仑穴6秒钟，如此反复10次。
                                    </p>
                                    <p>
                                        <span>痛经：</span> 按摩行间穴可治痛经，行间穴位于足背侧，当第1、2趾间，趾蹼缘的后方赤白肉际处，稍微靠大拇趾边缘。布有来自腓深神经的趾背神经，足背静脉网及第一趾背动、静脉。用大拇指指尖掐。按压行间穴5秒钟，压倒有酸感后，休息5秒钟再按压，一共20次。
                                    </p>
                                    <p>
                                        <span>脑血栓：</span>按摩秩边穴可治脑血栓，坐位，在骶骨，先取下髎穴，再旁开量4横指（即3寸）处，按压有酸胀感。先用深沉力度揉按秩边穴，接着按顺、反时针方向旋转揉按各60圈，直到皮肤发热以后，再用手掌拍打穴位的周围，使周围的肌肉也放松，5分钟见效。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" data-month="3-4">
                                <span>寅时</span>
                                <span>3时-5时</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe638;</i>
                            <div class="cbp_tmlabel">
                                <h2>肺经</h2>
                                <div class="time-content ten-cont">
                                    <p>
                                        <span>常规：</span>寅时睡得熟，色红精气足。大地阴阳从此刻转化，由阴转阳。人体此时也进入阳盛阴衰之时。肺朝百脉，气运输于全身。肝脏在丑时把血液推陈出新之后，将新鲜血液提供给肺，通过肺松往全身。所以人在清晨面色红润，精神充沛，迎接新的一天到来，此时人也容易死亡，此时起床运动最好缓慢。而肺不好的人会经常咳嗽，就算是睡着后也会咳嗽，有些人可能在睡着后，咳得更厉害。
                                    </p>
                                    <p>
                                        <span>老年养生：</span>老年人“黎明前的黑暗”，此时50岁以上者最容易发生意外。血压处于一天中最低值，糖尿病病人易出现低血糖，心脑血管患者易发生心梗等。
                                    </p>
                                    <p>
                                        <span>不通症状：</span>肺经不通的表现为：怕风易汗咽干咳嗽；过敏性鼻炎皮肤干燥容易过敏；动则气短胸翳面色皮肤无华。咳嗽、气喘、胸闷、鼻咽炎、皮肤的斑、疹、痘。咽喉干燥喑哑，四肢麻木或发冷，失眠等。
                                    </p>
                                    <p>
                                        <span>糖尿病：</span>糖尿病患者如果你早早就醒了，这个时候先别着急起来，再睡一会，如果睡不着的话可以尝试闭眼休息，或者对腹部进行按摩，有助于新一天精神状态的提升。
                                    </p>
                                    <p>
                                        <span>痛风：</span>痛风病患者的一个危险期，往往这个时候发作的病情都比较急，表现为疼痛，肿、胀、发热，如果出现此类症状，建议平躺，抬高患肢，穿硬质鞋底的鞋，多饮水，实在难受可用冰敷或去疼片缓解。
                                    </p>
                                    <p>
                                        <span>减肥：</span>按摩胞盲穴可减肥。采用俯卧的姿势，位于身体臀部，平第二骶后孔，督脉旁开3寸处取穴。找一个有椅背的座椅，手握拳，将食指的拳骨贴于胞盲穴，掌心贴于椅背，用力向后靠，会感到穴位有按压感，以感觉酸痛为准，每次50下，可做2-3组。
                                    </p>
                                    <p>
                                        <span>感冒：</span>按摩合谷穴可治感冒，在手背，第2掌骨桡侧的中点处，手拇指、食指张开呈90度，以左手拇指指尖关节横纹压在右手虎口上，指尖点到处即是。指压时一面缓缓吐气一面用拇指、食指上下捏压6秒钟，然后迅速离开，手指离开时，应保持气已吐尽状态，如此重复10次。
                                    </p>
                                    <p>
                                        <span>腰间盘突出：</span>按摩昆仑穴可治腰间盘突出，昆仑穴位于脚踝外侧，在外踝顶点于脚跟相连接的中央点（足外踝后方，当外踝尖与跟腱之间的凹陷处）。先将肌肉放松，一边缓缓吐气一边强压昆仑穴6秒钟，如此反复10次。
                                    </p>
                                    <p>
                                        <span>痛经：</span>按摩三阴交穴可治痛经，在小腿内侧，正坐屈膝成直角，足内踝上缘，自己的手横着放，四指宽处，按压有一骨头为胫骨，此穴位于胫骨后缘靠近骨边凹陷处。拇指立起来，放在三阴交穴的表面，先用力向下按压，再去揉，揉一分钟停下来，间隔一下，再揉一分钟。因为下肢部的穴位肌肉比较丰厚，用力点下去之后再去揉，坚持时间比较长，可以起到持久的刺激作用，值得注意的是，孕初期的女性，一定不要刺激三阴交穴。
                                    </p>
                                    <p>
                                        <span>脑血栓：</span>按摩至阴穴可治脑血栓，位于人体的足小趾末节外侧，距趾甲角0.1寸。用大拇指按揉至阴穴100—200次，以感到酸麻为准，力度不易过大。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" data-month="5-6">
                                <span>卯时</span>
                                <span>5时-7时</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe639;</i>
                            <div class="cbp_tmlabel">
                                <h2>大肠经</h2>
                                <div class="time-content ten-cont">
                                    <p>
                                        <span>常规：</span>卯时大肠蠕，排毒渣滓出。这是手阳明大肠经活跃的最佳时段。“肺与大肠相表里”，寅时肺将充足的新鲜血液布满全身，紧接着促进大肠进入兴奋状态，完成吸收食物中的水分和营养、排出渣滓的过程。
                                    </p>
                                    <p>
                                        <span>老年养生：</span>老年人从此刻起精神状态逐渐饱满，血压开始升高，心跳渐渐加快，高血压患者得吃降压药了，岁数大的人觉比较少，此时起床可以先喝一杯温白开水，注意从起床20分钟，各种动作都要慢。
                                    </p>
                                    <p>
                                        <span>不通症状：</span>大肠经不通的表现为：牙痛头痛口干皮肤过敏；青筋斑点多肠胃功能减弱；肩周疼慢性咽喉炎。腹痛，腹胀，腹泻，便秘，咽痛，颊肿，鼻炎，手臂无力，上支不遂等
                                    </p>
                                    <p>
                                        <span>糖尿病：</span>糖尿病患者最适宜在6:30左右起床，此时身体已经准备就绪。醒来首先给自己测量一下空腹血糖，接着喝一杯温水，帮助补充身体的水份，提升精神状态。可以到户外呼吸新鲜空气，听听鸟叫，一个好心情对糖尿病人非常重要。
                                    </p>
                                    <p>
                                        <span>痛风：</span>痛风病患者最好的起床时间是早上的5-6点，比普通人要早一些，起来之后先喝一杯温水，然后去排大小便，没有也最好蹲一会，千万不要空腹晨起运动，有太阳的话可以晒晒后背，对痛风的调理有作用，保持的好的心情，开始崭新的一天。
                                    </p>
                                    <p>
                                        <span>减肥：</span>一日之计在于晨，减肥者要早起，身体经过昨晚的代谢，糖份被消耗，这时候做些减肥运动会提前进入消耗脂肪提供能量的阶段，能够提高燃脂效率，瘦身效果事半功倍，这里推荐两种运动，如果你附近有操场的话可以尝试慢跑，如果没有可以跳绳，速度不用快，科学证明，运动30分钟后才会燃烧脂肪，请尽量保持足够的运动量，注意身体过重者请缩短时间，以免造成关节损伤，循序渐进。
                                    </p>
                                    <p>
                                        <span>感冒：</span>此时起床先做一个搓手按摩吧，两手掌对搓5-10分钟即可，搓手可促进血液循环、疏通经脉、增强上呼吸道地狱感冒的免疫能力，有鼻塞者可到一杯热水，对着热气做深呼吸，直到杯中水变温为止，此法可缓解鼻塞，此时大肠经当行尽量上厕所排大便，当前的排便对感冒恢复有帮助。另外如果洗漱的话不建议水温过高，感冒初期请尽量用冷水洗脸，开窗通风。
                                    </p>
                                    <p>
                                        <span>腰间盘突出：</span>腰突者最好在日出后起床，不宜过早，时间6-7点， 起床也要讲究方法，一不小心很可能恶化病情，仰躺时，要先将两腿弯曲，翻身侧卧，再将双脚移到床沿边，利用双手用力向上站立，很多患者在晨起后腰部有疼痛感，别担心，活动下就好了，推荐用手背搓腰眼，力度以感到匍匐便面灼热为宜，此法对缓解腰突很有效果，时间5-10分钟即可，上班若不远尽量选择步行，女性别穿高跟鞋。
                                    </p>
                                    <p>
                                        <span>痛经：</span>痛经者不宜起床过早，5点之前阳气不旺，容易引起头痛，建议在6:30左右起床，喝杯姜糖水能起到活血通络的功效，月经来潮的前一周饮食宜清淡，可以吃豆类、鱼类等高蛋白食物，并增加绿叶蔬菜、水果，也要多饮水，以保持大便通畅，减少骨盆充血，月经来潮初期，女性常感到腰痛，此时不妨对吃一些开胃、易消化的食物，如枣、面条、白粥、薏米粥等；不建议喝牛奶，牛奶性寒伤到阳气加重痛经。
                                    </p>
                                    <p>
                                        <span>脑血栓：</span>脑血栓患者不宜起床过早，5点前阴气较盛，气血受到影响加重病情，建议在6:30左右起床，动作要慢，不可用力转头‘晃头；陈琦一杯温水要每天坚持；此时要入厕排二便，不宜用蹲便，如果出现头晕、视力模糊要格外注意，可能是发病前兆，养成早上测血压的习惯。突然升到200/120以上且持续不降，或降到80/50mmHg以下，要及时就医，义务要选择宽松柔软的，穿平底鞋。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" data-month="7-8">
                                <span>辰时</span>
                                <span>7时-9时</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe63a;</i>
                            <div class="cbp_tmlabel">
                                <h2>胃经</h2>
                                <div class="time-content ten-cont">
                                    <p>
                                        <span>常规：</span>当前胃经最旺，人在7:00吃早饭最容易消化，如果胃火过盛，表现为嘴唇干，重则唇裂或生疮，胃经畅通无堵，人就睡的香，胃口好，脸色红润，还可以返老还童。胃经是管理肠胃功能的，肠胃一旦失调，整个人就会虚弱下来。
                                    </p>
                                    <p>
                                        <span>老年养生：</span>老年人建议在6:30-7：00间吃早饭，饭前刷牙，这么做可以防止牙齿腐蚀，因为刷牙之后，可以在牙齿表面上涂上一层含氟的保护层。对于老年人来讲，早饭必须吃，它可以帮助维持血糖水平的稳定，推荐吃低血糖指数的食物，饭后建议休息半小时，避免剧烈运动，或适合步行锻炼。
                                    </p>
                                    <p>
                                        <span>不通症状：</span>胃经不通表现为：喉咙痛、胃痛、消化不良，倦怠膝关节疼痛便秘；唇干舌燥身体消瘦。喜冷饮、口唇干裂、口臭、腹胀、胃痉挛性疼痛，胃酸过多，灼热，大便干燥或多日不便、小便黄、口腔糜烂、牙龈肿痛出血等
                                    </p>
                                    <p>
                                        <span>糖尿病：</span>糖尿病患者此时应当吃早餐了，一定要吃好，但也不要吃太多，主食宜吃全麦面包、菜包子、咸馒头、花卷等谷类食物。另外牛奶、豆浆含蛋白质水份多，可以补充糖尿病患者需要的钙质和优质蛋白质。推荐食谱：燕麦面包2片（50g），鲜牛奶1袋（250g），鸡蛋1个，咸菜少许。
                                    </p>
                                    <p>
                                        <span>痛风：</span>痛风患者推荐7点吃早餐，可以选择牛奶、乳酪、蛋白质、谷类、面粉等；蔬菜的话，最好选择一半为深色的，如红色西红柿、橘色胡萝卜、紫色茄子等，痛风患者不宜喝豆浆、咖啡、咳咳，不宜吃油条，含油较大的老，切记。
                                    </p>
                                    <p>
                                        <span>减肥：</span>吃早餐的最佳时间是7-8点，人在睡眠时，绝大部分器官都得到了充分的休息，而消化器官缺仍在消化吸收晚间存留在胃肠道中的食物，到早晨才进入休息状态，一旦早餐太早，势必会干扰肠胃的休息，是消化系统长期处于疲劳应战的状态，扰乱肠胃的蠕动节奏，所以不要因为起得早就提前吃早餐，起床后可以舒展筋骨再进食，推荐吃暖的流食，主食选全麦面包。
                                    </p>
                                    <p>
                                        <span>感冒：</span>感冒了很多人都会食欲不振，早餐一定要吃，否则只会让病情更严重，吃的要清淡有营养，如菜汤、稀粥、蛋汤、蛋羹、牛奶等。推荐喝小米粥，它具有补虚损、益脾胃的作用，对感冒者很适用，水果蔬菜多食用含有维生素C的，比如橙子、柚子、柠檬，要多喝水，这是关键，一天的水不能断，有嗓子疼的症状可以加点盐，别喝凉水。
                                    </p>
                                    <p>
                                        <span>腰间盘突出：</span>在中医理论中，腰是肾的房屋，腰间盘突出中医理论中，腰是肾的房屋，腰间盘突出就像肾的房子漏了，实际上与肾和气血有关，因此早上应吃些补肾益气的食物，如黑豆、黑芝麻、首乌、枸杞、南瓜子、核桃、大枣，花生、小米、糯米、大豆、白扁豆等，最好配上一杯热牛奶或者豆浆，会更好的利于吸收，如有时间可做核桃栗子红豆养生粥：将核桃肉洗干净捣碎，跟栗子红豆熬成粥，有补肾壮腰、活血的功能。
                                    </p>
                                    <p>
                                        <span>痛经：</span>此时段全天阳气最足，8-9点钟的太阳多晒晒对痛经有好处，气血瘀滞是形成痛经的主要原因，所以现在最好多动，动则生阳，如果离公司较近就步行吧；经期内裤上的细菌比平时多几倍，要每天更换，不穿紧身衣，高跟鞋衣物最好选择棉质的，注意保暖，别穿裙子。
                                    </p>
                                    <p>
                                        <span>脑血栓：</span>脑血栓患者的早餐忌油炸，最好采用蒸煮炖熬的方式，以豆类谷类为主，如黄豆、红豆、黑豆、大米、玉米面、豆豉、扁豆、小麦等；饮品推荐牛奶或豆浆，尽量不放糖，要保证少糖少盐；不吃咸菜，鸡蛋可以吃，但每周不超过3个，推荐每晨空腹进糖醋打算1-2粒，并喝少许醋汁，对病情有调理作用。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" data-month="9-10">
                                <span>巳时</span>
                                <span>9时-11时</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe63b;</i>
                            <div class="cbp_tmlabel">
                                <h2>脾经</h2>
                                <div class="time-content ten-cont">
                                    <p>
                                        <span>常规：</span>此时脾经最旺。“脾主运化，脾统血。”脾是消化、吸收、排泄的总调度，又是人体血液的统领。“脾开窍于口，其华在唇。”上个时辰吃完早餐，如果人体的脾运化功能好的话，就可以顺利的消化和吸收。脾主思，也与智有关，此时是学思能力最佳的时段，用来学习事半功倍。
                                    </p>
                                    <p>
                                        <span>老年养生：</span>老年人此时是一天中最精神的时候，如果有什么想做的工作可以选择这个时候来完成，也可以进行阅读，陪小孩玩都行。肾功能不好的老年人可以在这个时候让阳光晒晒背后，有补肾的功效。
                                    </p>
                                    <p>
                                        <span>不通症状：</span>脾经不同的表现为：脘腹胀气吸收不良口淡；容易呕吐做闷，容易倦怠虚胖；头胀头脑不清湿重脚肿便溏；关节酸胀糖尿病。消瘦或肥胖，消化不好，胃胀气，呕吐，肢倦乏力麻木，嗜睡，皮肤损伤，肢体活动不利等。
                                    </p>
                                    <p>
                                        <span>糖尿病：</span>糖尿病患者如果实在工作，这个时候最好让眼睛休息一下，多看看窗外，喝点水，最好是每一个小时都进行适当的休息。可以做开胸式按摩，前臂曲起和脸部平行，做开胸运动30次。配合呼吸，双手合实吸气，打开是呼气，此法可以帮助胰脏活动。
                                    </p>
                                    <p>
                                        <span>痛风：</span>痛风病患者每天头脑最清醒的时候，应该把重要的事情放在这个时间段做，但要注意劳逸结合，避免过劳，电脑前工作的，30分钟活动一下手腕，肩膀，脖子，你们比平常人更容易疲劳，从而导致痛风病严重。
                                    </p>
                                    <p>
                                        <span>减肥：</span>按摩天枢穴可减肥，在腹部，横平肚脐中央，前正中线旁开2寸处。可以用掌根从左至右按揉两个天枢穴；也可以以肚脐为中心画圆，这种按摩叫做摩扶法，这也是最常用的按摩手法。
                                    </p>
                                    <p>
                                        <span>感冒：</span>按摩环跳穴可治感冒，位于人体的股外侧部，侧卧屈股，当股骨大转子最凸点与骶管裂孔连线的外三分之一与中三分之一交点处。两手握拳，手心向内，两拳同时锤打两侧环跳穴各50下或者两手抱膝搂怀后再伸直，从此反复，一伸一屈共做50下。
                                    </p>
                                    <p>
                                        <span>腰间盘突出：</span>按摩伏兔穴可治腰间盘突出，屈膝90°，手指并拢压腿上，掌后第一横纹中点按在髌骨上缘中点，中指尖端处即是。最好采取指压带揉动的方式，按压时间3分钟，之后用手掌小鱼际敲击伏兔穴2-3分钟效果会更好。

                                    </p>
                                    <p>
                                        <span>痛经：</span>按摩血海穴可治痛经，坐在椅子上，将腿绷直，在膝盖内侧会出现一个凹陷的地方，在凹陷的上方有一块隆起的肌肉，肌肉的顶端就是血海穴。两个大拇指重叠按压这个穴位，在腰上放一个暖水袋效果会更好，每一侧3分钟，要掌握好力道，不易大力，只要能感觉到穴位有微微的酸胀感即可。
                                    </p>
                                    <p>
                                        <span>脑血栓：</span>按摩至阴穴可治脑血栓，位于人体的足小趾末节外侧，距趾甲角0.1寸。用大拇指按揉至阴穴100—200次，以感到酸麻为准，力度不易过大。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" data-month="11-12">
                                <span>午时</span>
                                <span>11时-13时</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe63c;</i>
                            <div class="cbp_tmlabel">
                                <h2>心经</h2>
                                <div class="time-content ten-cont">
                                    <p>
                                        <span>常规：</span>当前心经最旺。“心主神明，开窍于舌，其华在面。”心气推动血液运行，养神，养气，养筋。是气血运行的最佳时期，不宜剧烈运动，午时跟子时相对应，在全天最热的时候，应在午时小憩片刻，对于养心大有好处，可使下午乃至晚上精力充沛。
                                    </p>
                                    <p>
                                        <span>老年养生：</span>老年人最好在11:30到12:30吃午餐，多吃一些豆类蔬菜，肉适当有一点即可，要喝一碗汤，饭后可吃点水果，这是一种解决身体血糖下降的好方法。吃一个橙子或一些红色水果，这样做能同时补充体内的铁含量喝维生素C含量。
                                    </p>
                                    <p>
                                        <span>不通症状：</span>心经不通的表现为：心烦心惊心悸心闷心痛；短气上气有压力感忧郁易怒；口腔溃疡口干口臭。心慌，胸闷，气短，手脚凉，自汗或出冷汗；乏力、失眠、健忘，经常有晕眩感等。
                                    </p>
                                    <p>
                                        <span>糖尿病：</span>糖尿病患者的午餐时间在12点左右，要选择低血糖指数的食物，例如大米饭，再配合低脂肪含量的瘦肉、鸡或鱼以及蔬菜，蔬菜对降低血糖指数有很大帮助，且含维生素及矿物质，午餐时可多吃点，豆类也是很好的选择，因为豆类富含丰富的蛋白质、铁及纤维等。
                                    </p>
                                    <p>
                                        <span>痛风：</span>痛风病患者中午吃饭前半小时，喝一杯水吧，养成规律的午餐时间对痛风很有好处，建议12点左右。另外猪、牛、羊肉、火腿、香肠、鸡、鸭、鹅、兔以及各种动物内脏（肝、肾、心、脑）、骨髓等含嘌呤量高，应尽量不吃；鱼虾类、菠菜、豆类、蘑菇、香菜、花生等也有一定量的嘌呤，要少吃；大多数蔬菜、各种水果、牛奶和豆制品、鸡蛋、米饭、糖等可以吃。
                                    </p>
                                    <p>
                                        <span>减肥：</span>午餐时间最佳选在12点半左右，助瘦的进食顺序：先吃蔬菜，“热量密度”越低的食物要先吃，烹调方式应尽量是用水炒或蒸、煮的方式；吃完蔬菜可以喝一些汤，使刚刚吃进去的蔬菜在胃中有饱足感；此时你的胃已经快半饱了，可以吃些鱼、肉、蛋类的高蛋白食物最后吃主食，尽量把白米饭换成五谷杂粮饭或糙米燕麦饭，这样对体重的控制就更有帮助了。
                                    </p>
                                    <p>
                                        <span>感冒：</span>午餐时间控制在12点左右，尽量选择流质的易消化食物。以下几类不宜食用：1.甜食（高糖水果也算）；2.高盐食物（每日吃盐量控制在5克以内）；3.粗纤维食物（如芹菜，茼蒿等）；4.辛热食物；5.浓茶、咖啡等；6.烧烤煎炸之品；7.忌刺激性强的调味品（对呼吸道粘膜不利）；8.鸭羊肉；9.香菜；10.柿子；午时阴阳交替，不宜惊扰，饭后散散步，静静待着就行。
                                    </p>
                                    <p>
                                        <span>腰间盘突出：</span>腰突者不宜吃饭过晚，保证在12:30前吃上午餐，饮食首先要忌高脂肪、油炸、硬质食物，这些食物不利于消化，影响疾病恢复；忌辛辣刺激之物，辣椒、辣酱、韭菜、大蒜等；还要注意忌腥膻之物，如黑鱼、鲤鱼、鲫鱼、鲸鱼、海虾、带鱼、淡菜、乌贼鱼等。多摄入一些钙，蛋白质，维生素B等含量多的食物。
                                    </p>
                                    <p>
                                        <span>痛经：</span>痛经者午餐时间可以早点，尽量保证12点前，不能吃以下食物：1.生冷寒凉食品，会导致血行受阻，包括：各类冷饮、各类冰冻饮料、冰镇酒类、生拌凉菜、螃蟹、田螺、蚌肉、蛭子、梨、柿子、西瓜、黄瓜、荸荠、柚、橙子等；2.酸涩食物，味酸性寒，具有固涩收敛作用，不利于经血的畅行，包括：米醋、酸辣菜、泡茶、石榴、青梅、杨梅、草莓、杨桃、樱桃、酸枣、芒果、杏子、李子、柠檬等；3.刺激性食物，如：辣椒、胡椒、大蒜、葱、姜、韭菜、烟、烈性酒及辛辣调味品等。12点后尽量不活动，此时天地之气转换，安静的休息一下吧，别吹空调。
                                    </p>
                                    <p>
                                        <span>脑血栓：</span>11:00左右推荐喝杯山楂茶，鲜山楂用开水浸泡当茶饮，有助降血脂；午饭最好12:00之前吃，忌高脂肪、高热量食物，如：肥肉、动物内脏、鱼卵、蛋黄、猪油等；忌生、冷、辛辣刺激性食物，如白酒、麻椒、麻辣火锅、辣椒、洋葱、胡椒粉等；忌肥甘甜腻之物，如甜味饮品、奶油蛋糕、各种酱料等；不宜食用油炸、煎炒、烧烤饭菜；此时应多吃润肺食物，注意包括黑木耳、白萝卜、海带、藕、丝瓜、花生等。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" data-month="13-14">
                                <span>未时</span>
                                <span>13时-15时</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe63d;</i>
                            <div class="cbp_tmlabel">
                                <h2>小肠经</h2>
                                <div class="time-content ten-cont">
                                    <p>
                                        <span>常规：</span>当前小肠经最旺。小肠有一个主要的功能叫分清泌浊，就是把从胃里消化来的食物中的营养东西吸收了，把糟粕的东西排出去。按摩小肠经可改善肩颈和颈椎疾病，并能起到大脑供血的作用。
                                    </p>
                                    <p>
                                        <span>老年养生：</span>老年人此刻应该进行午休，如果睡不着可以选择闭目养神。雅典的一所大学研究发现，那些每天午休30分钟或者更长时间，每周至少午休3次的人，因心脏病死亡的几率会下降37%。
                                    </p>
                                    <p>
                                        <span>不通症状：</span>小肠经不通的表现为：小腹绕脐而痛心翳闷头顶痛；容易腹泻手脚寒凉；吸收不良虚胖；肩周炎。吸收功能差，颌、颈浮肿，耳鸣，听力减退，呕吐，腹泻，手虚弱寒冷，身疲，虚弱症，牙痛等。
                                    </p>
                                    <p>
                                        <span>糖尿病：</span>糖尿病患者要养成午休的好习惯，时间30到60分钟，醒后可以简单活动，拉伸身体，帮助提神，更好的投入下午的工作，推荐喝一杯苦瓜茶，将1-2片苦瓜片用水冲泡即可饮用。苦瓜中含有苦瓜甙，有明显降糖的作用，要注意避免过度劳累和情绪波动，如出现疲劳、饥饿、心慌、出汗状况时，即为低血糖反应，可立即口服糖水。
                                    </p>
                                    <p>
                                        <span>痛风：</span>痛风病患者要保证足够的休息，如果可以，建议午睡30分钟，如果条件不允许，可以选择喝一杯普洱茶，不要太浓，淡淡的就行，小肠经运行的时候，痛风患者最好不要太活跃，静静的待着就可以，让体内的营养被小肠吸收，强壮的身体更有益于排出嘌吟。
                                    </p>
                                    <p>
                                        <span>减肥：</span>减肥者是可以睡午觉的，这恰恰是人体保护生物节律的一种方法，不会影响到减肥。但是要注意以下几点：1.不要饭后即睡：刚吃了午饭，胃内充满了食物，不利于食物的吸收，最好选择饭后半小时；2.时间不宜过长，以10-30分钟左右为宜；3.注意睡的姿势：一般认为睡觉正确的姿势是以右侧卧位为好，因为这样可使心脏负担减轻，肝脏血流量加大，有利于食物的消化代谢。但实际上，由于午睡时间较短，可以不必强求卧睡的偏左、偏右、平卧，只要能迅速入睡就行。将裤带放松，便于胃肠的蠕动，有助于消化。
                                    </p>
                                    <p>
                                        <span>感冒：</span>一天中阳气最足的时候已经过去，现在逐渐由阳转阴，此刻容易感觉身体很冷，建议测量一下体温。午睡的话一定要注意保暖，特别是背部和腹部，尽量不趴在桌子上睡觉；午休条件不好的话，闭目养会神就行。下午2点后推荐喝杯红糖姜水，取生姜5大片加红糖煮水喝，可以尽快排除寒气。
                                    </p>
                                    <p>
                                        <span>腰间盘突出：</span>腰突者如果午休，一定要注意腰部膝盖下查一下你的坐姿，应该是上身挺直，收腹，双腿膝盖并拢，有条件，可在双脚下垫一踏脚或脚蹬，使膝关节略微高出腹部，良好的坐姿对调整腰突至关重要；小肠经主管吸收，此时喝一杯姜茶补气血效果更好，对病者有帮助。
                                    </p>
                                    <p>
                                        <span>痛经：</span>小肠经是阴盛阳衰的开始，加上大半天的工作，此时痛经极易发作，合谷穴是缓解痛经第一穴，用一手拇指和其他四指并拢，位于大拇指和食指掌背背部肌肉隆起的部位，再用另一手的拇指点按20下，左右手共40下，以感觉酸痛难受为度；注意体质差者刺激不宜强，孕妇不宜按摩；不要喝咖啡，浓茶；推荐喝益母草+红糖水，能祛瘀活血；下午工作避免长期保持一个姿势，每半小时活动一下，按按大腿，有助于淤血排出。
                                    </p>
                                    <p>
                                        <span>脑血栓：</span>脑血栓患者切勿吃完就睡，很危险，建议饭后40分钟再午休，此时可以做个小练习，站立姿势，将脚跟抬起，用脚尖支撑身体，反复进行15分钟左右即可；如果你从早上到现在一直打哈欠，要格外注意，测一下血压吧，可能有发病危险；下午注意脚部的保暖，每隔一个小时活动一下，脚是人体末梢，血管有问题，脚先知；此时可以喝点绿茶，茶多酚能防止血栓形成。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" data-month="15-16">
                                <span>申时</span>
                                <span>15时-17时</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe63e;</i>
                            <div class="cbp_tmlabel">
                                <h2>膀胱经</h2>
                                <div class="time-content ten-cont">
                                    <p>
                                        <span>常规：</span>此时膀胱经最旺。膀胱贮藏水液和津液，循环水液并将多余部分排出体外，津液在体内循环。膀胱经是人体最大的排毒通道，是可以走到脑的一条经，头脑最灵活的一段时间。健康的人这时则是复习和阅读的好时光，所以古人主张“朝而受业，夕而复习”。这时由于气血容易输于脑部，学习效率就会很高。足太阳膀胱经是最长的一条经以猴为形容上蹿下跳。申时人体体温较热，阴虚的人尤为突出。此时适当的活动有助于体内津液循环。
                                    </p>
                                    <p>
                                        <span>老年养生：</span>老年人这个时候可以选择继续干点工作，或者喝点茶也行，推荐普洱茶、绿茶，也可以来杯酸奶，这样做可以稳定血糖水平。在每天三餐之间喝些酸牛奶，有利于心脏健康。
                                    </p>
                                    <p>
                                        <span>不通症状：</span>膀胱经不通的表现为：恶风怕冷颈项不舒服腰背肌肉胀痛；腰膝酸软静脉曲张尿频尿多；尿黄前列腺肥大。小便异常，头项强痛，脊背痛，目刺痛，腰痛如折等。
                                    </p>
                                    <p>
                                        <span>糖尿病：</span>糖尿病患者此刻最适合做一些经络按摩，这个病从中医角度讲主要就是脾经有问题造成的，现在正是膀胱经当行，此经络不通的话脾经很难疏通，膀胱经的大多数穴位都集中在小腿上，可以用两手按摩小腿5-10分钟，对糖尿病有间接的理疗作用。
                                    </p>
                                    <p>
                                        <span>痛风：</span>痛风病患者最适合按摩的时段，中医讲经络不通要从膀胱经入手，此时正是它运行的时候，痛风患者可以选择做眼保健操挤按睛明穴（内眼角处），然后再揉揉小腿肚，各5分钟，这么做可以疏通整个膀胱经，从而间接治疗痛风。
                                    </p>
                                    <p>
                                        <span>减肥：</span>按摩天枢穴可减肥，在腹部，横平肚脐中央，前正中线旁开2寸处。可以用掌根从左至右按揉两个天枢穴；也可以以肚脐为中心画圆，这种按摩叫做摩扶法，这也是最常用的按摩手法。
                                    </p>
                                    <p>
                                        <span>感冒：</span>按摩少商穴可治感冒，将大拇指伸直，用另一手大拇指弯曲掐按该收大拇指甲角边缘处即是。首先两手微握拳，以屈曲的拇指背面上下往返按摩鼻翼两侧，直到鼻翼呈局部红、热，然后捏拿少商穴30次。
                                    </p>
                                    <p>
                                        <span>腰间盘突出：</span>按摩承筋穴可治腰间盘突出，仰卧位，在小腿后，委中穴与承山穴的连接中点下1横指处。用大拇指按揉或弹拨筋穴100-200次，有酸胀感为宜。
                                    </p>
                                    <p>
                                        <span>痛经：</span>按摩太渊穴可治痛经，坐位，伸臂侧掌，在腕横纹桡侧轻触桡动脉，从感觉到脉动处稍往桡侧移动，至凹陷处。用大拇指按压太渊穴片刻，然后松开，反复5-10次（用拇指及甲尖掐按太渊穴，每次左右各按1-3分钟）。
                                    </p>
                                    <p>
                                        <span>脑血栓：</span>按摩足通谷穴可治脑血栓，位于人体的足外侧，足小趾本节（第5跖趾关节）的前方，赤白肉际处。用食指第二关节用力按压足通谷穴，力度可适当大一些，最好再按此穴之前泡个脚，这样效果会更好。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" data-month="17-18">
                                <span>酉时</span>
                                <span>17时-19时</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe63f;</i>
                            <div class="cbp_tmlabel">
                                <h2>肾经</h2>
                                <div class="time-content ten-cont">
                                    <p>
                                        <span>常规：</span>此时肾经最旺。“肾藏生殖之精喝五脏六腑之精。肾为先天之根。”对机体各方面的生理功能均起着极其重要的作用。人体经过申时泻火排毒，肾在酉时进入贮藏精华的阶段。此时不适宜太强的运动量，也不适宜大量喝水。另外，青春期或新婚后的男子要注意不要房事，非常伤精气。
                                    </p>
                                    <p>
                                        <span>老年养生：</span>老年人晚饭时间推进18点左右，不要吃过饱，这样会引起血糖升高，并增加消化系统的负担，影响睡眠。晚饭应该多吃蔬菜，少吃富含卡路里和蛋白质的食物。吃饭时要细嚼慢咽，饭后稍作休息可以运动，老年人推荐跳跳广场舞，也可以选择快步走，游泳等低损耗有养运动，时间以30分钟左右为宜。
                                    </p>
                                    <p>
                                        <span>不通症状：</span>肾经不通的表现为：手足怕冷口干舌燥腰膝酸痛咽喉炎；月经不调性欲减退；前列腺肥大足跟痛尿频尿少尿黄。手脚心热、燥热不安、口渴，颧红腮热，血糖、尿糖、血脂偏高，少尿，尿黄，口干，性欲减退，女性月经异常等。
                                    </p>
                                    <p>
                                        <span>糖尿病：</span>糖尿病患者一定要吃晚饭，但要清淡一点，七分饱即可，人体在晚上合成脂肪的能力是白天的二十多倍，晚餐吃得过多容易导致血糖上升，是糖尿病高发的主要因素。晚餐半小时之后可以适量吃点水果，但对于糖尿病人要慎重选择，水果分量不要超过200克（一两），可以选择的种类有青梅、西瓜、甜瓜、橙、柠檬、葡萄、桃、李、杏、枇杷、菠萝、草莓、蔗糖、椰子、樱桃、橄榄等。
                                    </p>
                                    <p>
                                        <span>痛风：</span>痛风病患者控制在18点左右吃晚餐，注意多饮水，少喝汤，多喝白开水，少喝肉汤、鱼汤、鸡汤、火锅汤等。白开水的渗透压最有利于溶解体内各种有害物质，餐饭吃些碱性食物，能帮助补充钾、钠、氯离子。碱性食物包括：1.蔬菜、水果类；2.海藻类；3.坚果类；4.发过芽的谷类、豆类等；保证“三低一高”，即低嘌呤或无嘌呤饮食、低热量摄入、低盐饮食，另外千万不要喝酒！
                                    </p>
                                    <p>
                                        <span>减肥：</span>尽量在7点之前吃完晚餐。这样在睡觉的时候可以消化完，胃里在夜里才不会有积食，晚餐少吃，它在一日三餐中应是最少的，千万不要吃油腻的，辛辣，淀粉含量高的食物，例如炸鸡，辣子鸡，火锅，红薯，土豆等；应该吃新鲜的绿叶青菜，容易消化的食物，鱼类，煲汤喝汤，主食少吃，尤其是面粉制品不要吃；晚餐后不要立即坐着，最少站立40分钟后再坐。
                                    </p>
                                    <p>
                                        <span>感冒：</span>晚餐时间推荐喝完鸡汤，能抑制咽喉及呼吸道炎症，对消除感冒引起的鼻塞、流涕、咳嗽、咽喉痛等症状极为有效；另外食用萝卜，洋葱，大蒜对感冒也都有好处，能清热、解毒、驱寒；提醒：感冒期间不要喝酒，特别是服用类似头孢等药物后，晚上没有胃口可少食，但要注意多喝水，一定要时刻保证水的摄入，白开水。感冒是可自愈性疾病，如不是很重，尽量不打点滴。
                                    </p>
                                    <p>
                                        <span>腰间盘突出：</span>腰突者晚餐时间要早一点，建议7点之前吃完，多吃些含维C的蔬菜，如青椒，番茄，韭菜，菜花，青蒜等，另外猪肝，鸡肝之类的动物肝脏也可以适当来点，七分饱即可，避免肥胖。不饮酒，不喝碳酸饮料，烟民的话要克制尽量不在晚上抽烟；晚饭后推荐吃点新鲜水果，如梨、葡萄、苹果、猕猴桃等。
                                    </p>
                                    <p>
                                        <span>痛经：</span>因为痛经者需早睡，晚餐时间别太晚，最好7点前吃完，此时要滋补，多摄入一些含铁丰富的食物，如：动物血、动物肝脏、畜禽肉类等动物性食物，以及黑木耳、海带、栗子、芝麻等植物性食物；最好有个热汤，推荐乌鸡汤；餐后可吃点水果，推荐榴莲、橙、柚子、葡萄、草莓、猕猴桃；其中榴莲是痛经者的滋补佳品，能健脾补气，活血散寒。
                                    </p>
                                    <p>
                                        <span>脑血栓：</span>戌时阴气占主导，脑血栓患者不宜在外久留，特别较冷天气；晚餐时间推荐6:30左右，建议多吃高纤维食物，如：竹笋、绿豆、香菇、银耳、马铃薯、胡萝卜、裙带菜、纳豆、豆腐等；主食可选择小米粥、煮烂的面条，疙瘩汤等易消化流食；就餐时配点醋有软化血管作用；饭后可吃些含维C水果，如鲜枣、猕猴桃、柚子、桂圆、番茄、黄瓜、菜花等；晚饭不可饱食，不可饮酒。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" data-month="19-20">
                                <span>戌时</span>
                                <span>19时-21时</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe640;</i>
                            <div class="cbp_tmlabel">
                                <h2>心包经</h2>
                                <div class="time-content ten-cont">
                                    <p>
                                        <span>常规：</span>此时心包经最旺，戌时护心脏，减压心舒畅。心包是心得保护组织，又是气血通道，可清楚心脏周围外邪，使心脏处于完好状态。此时最宜步行，可增强心功能。要保持心情舒畅，放松心情，释放压力。
                                    </p>
                                    <p>
                                        <span>老年养生：</span>老年人此时可以看会电视、或者看报，放松一下，有助于睡眠，但需要注意的是，尽量不要躺在床上看电视，这会影响睡眠质量，洗个热水澡吧，睡觉前洗澡或者泡脚，有助于放松和睡眠。
                                    </p>
                                    <p>
                                        <span>不通症状：</span>心包经不通的表现为：失眠多梦易醒难入睡；心烦健忘胸翳闷口干；神经衰弱。心慌，胸闷，气短，心烦，手心出汗，自汗不止。手臂挛急，腋肿等。
                                    </p>
                                    <p>
                                        <span>糖尿病：</span>糖尿病患者这个时段尽量做一些运动，能帮助降低餐后的血糖，提升身体对胰岛素的敏感度，运动不宜过于激烈，推荐散步，瑜伽。时间30分钟左右即可，量力而行。睡前可泡泡脚，但要注意用温水，不宜用过热的水，以免造成足部受伤，糖尿病最怕的就是足部外伤，看看电视，看看书都可以放松心情，帮助睡眠。
                                    </p>
                                    <p>
                                        <span>痛风：</span>痛风病患者此时应做适量的带氧运动，例如快走，太极，瑜伽，广场舞等。中医学有句话：“气行则学行、血行风自灭”。因此，治疗痛风，应以养气、行血及固肾为主，气血通畅、则尿酸不会积聚。特别是肥胖的人，积极减肥，减轻体重，这对于防止痛风病发颇为重要。
                                    </p>
                                    <p>
                                        <span>减肥：</span>此时推荐做瑜伽练习，即可燃脂又能帮助睡眠，好处多多，时间30分钟即可；晚上不要吃零食，这是减肥的铁令，不然就前功尽弃了；尽量确保卧室光线较暗，在完全黑暗的环境中睡觉时，身体会产生褪黑激素，它能让体内消耗更多热量；卧室的温度控制在18度左右，科学证明，这个温度会比在24度时，热量多燃烧7%。
                                    </p>
                                    <p>
                                        <span>感冒：</span>可在家做简单拉伸，时间20分钟以内；看电脑，电视时间不要超过一小时，感冒者气较弱，过分用眼会伤神，从而影响康复，可以吃点水果补充维生素，能增强抵抗力，苹果、梨都是不错的，有润喉的作用，如此刻有轻微晕眩，不要担心，用手按膻中穴20秒（心口窝）即可缓解。
                                    </p>
                                    <p>
                                        <span>腰间盘突出：</span>此时段对腰突者很重要，是每天的锻炼时间，适当的运动对这种病帮助很大，心包经当行时更是事半功倍。这里推荐两种运动，室外的话，可以找个空旷处倒退走，每次30分钟左右，这种锻炼有利于改善腰背肌状态，可帮助解除小关节粘连；室内的话，可做鱼跃练习，俯卧，两手放在腰部，把上身和两腿同时后伸抬起，做成弓状，注意膝部不要弯曲，尽量在这一姿势下维持一段时间。
                                    </p>
                                    <p>
                                        <span>痛经：</span>中医认为女性的痛经多源自肝郁，积极调节好心态非常重要，打开电视找个喜剧看看吧，可以吃点桃仁当零食，有破血行淤的功效；此时也可做运动：1.两手叉腰，两腿下蹲，下蹲时全身放松，站立时肛门和阴道收缩，连续20次；2.站在地上，两脚交替进行，摆动的幅度先小后大，速度先慢后快，循序渐进；不建议K歌，经期前后女性声带的毛细血管会充血，高声唱歌会损伤喉咙使声音沙哑。
                                    </p>
                                    <p>
                                        <span>脑血栓：</span>此刻不要马上休息，因饭后血液聚集于胃肠，过早睡眠易发病。可边看电视边做些运动；1.平躺在床上，把双脚抬高至45度，时间30秒，观察自己的两条腿，如果有一条腿苍白，等脚拿下去，恢复正常坐姿，这条腿会发生潮红，就说明已有腿部缺血症状，易形成血栓，此法可检测病情，也可做锻炼条理之用；2.用刮痧板刮两个手的中指及根部青筋处，有防治血栓作用。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" data-month="21-22">
                                <span>亥时</span>
                                <span>21时-23时</span>
                            </time>
                            <div class="circle"></div>
                            <i class="icon iconfont-d">&#xe641;</i>
                            <div class="cbp_tmlabel">
                                <h2>三焦经</h2>
                                <div class="time-content ten-cont">
                                    <p>
                                        <span>常规：</span>此时三焦经最旺，三焦是六腑中最大的腑，具有主持诸气，疏通水道的作用。人如果在亥时睡眠，百脉可休养生息，对身体十分有益。亥时是最后一个时辰，一天时间已经走完一个轮回，百脉进入休息状态，人应进入休息。百岁老人有个共同特点，即在亥时睡觉。
                                    </p>
                                    <p>
                                        <span>老年养生：</span>老年人最好在10点前入睡，早睡早起，调节生物钟对年龄大的人很重要，每晚至少保证睡够7小时，研究发现，晚上10点至凌晨2点大脑褪黑色素水平最高，是最佳的睡眠时间。
                                    </p>
                                    <p>
                                        <span>不通症状：</span>三焦经不通表现为：偏头痛头晕耳鸣上热下寒；手足怕冷倦怠易怒；皮肤容易过敏；肌肉关节酸痛无力食欲不振。上肢无力麻木，面色白，呼吸浅，尿少，精神与身体倦怠，忧郁，肌肉无力，听力障碍等，
                                    </p>
                                    <p>
                                        <span>糖尿病：</span>糖尿病患者睡眠时间最适合在晚上十点前，睡前洗个澡，水温不宜过高，比体温稍高一点就行，约38-39摄氏度。洗完后适当休息，然后再测一下睡前的血糖，根据血糖看是否需要加餐，或者喝一杯牛奶。注意不要熬夜，经常熬夜会引起血糖不稳定，而且也会影响身体的健康。
                                    </p>
                                    <p>
                                        <span>痛风：</span>痛风病患者最好在10点左右入眠，熬夜不利于尿酸排泄，相反会诱发痛风性关节炎。此时三焦经当行，三焦通则百脉通，可以说所以疼痛的病症都和它有关，痛风病人按摩一下外关穴（手腕横纹下两寸处）非常有好处，睡前洗个澡更有助于睡眠。
                                    </p>
                                    <p>
                                        <span>减肥：</span>晚上十点钟左右上床睡觉就可以了，不要太早，太早的话会导致睡太多，容易造成身体肥胖；太晚的话可能就会有熬夜的嫌疑，会导致内分泌失调，身体肥胖也会出现，同时太晚睡觉的话可能会出现饥饿感，忍不住去吃东西，这样非常不利于健康，也不利于减肥大计哦。
                                    </p>
                                    <p>
                                        <span>感冒：</span>感冒是外感之病，治疗应以疏散解表为主，所以休息很重要，最好是在十点半之前入睡。不太建议感冒还坚持洗澡，这时候抵抗力不是很强，就算是洗热水澡，也非常有可能加重病情。睡觉之前可以用热水泡个脚，推荐喝杯甘草茶，能防止半夜咽喉痛，做好手脚的保暖工作，床头柜上放好保温壶，杯子，手纸，这些都是你晚上的必需品。
                                    </p>
                                    <p>
                                        <span>腰间盘突出：</span>此时段应该准备入眠了，床是调理腰突的关键，最好的方式是木板上铺一两床薄被褥或棕榈垫，不能睡席梦思，也不能完全躺在硬木板上；要注意腰部的保暖，盖的被尽量选择比正常人大一些厚一些的；有条件可以泡个脚，加几片姜；用米醋煮一个鸡蛋，睡前吃有调理腰突效果。
                                    </p>
                                    <p>
                                        <span>痛经：</span>要保证充足睡眠，熬夜会导致肝血不足，加重痛经，尽量在10点前入睡，痛经者可以洗澡，但要采用淋浴或擦浴，不可泡澡；入睡前最好从大腿到小腿捏5分钟，用热水泡泡脚，可放藏红花，生姜，会加强气血疏通效果；保证被褥的保暖，脚底可放热水袋，不可行房事。
                                    </p>
                                    <p>
                                        <span>脑血栓：</span>脑血栓患者不宜劳累，推荐10点左右入眠，睡前泡个脚，可加入艾草，醋，有通经活络效果；务必保证被褥的保暖性，必要时可在脚底放一个暖水袋；睡前喝200ml的温水吧，很重要，可降低血粘度；此时做个口齿运动对病情很有帮助，把上下牙齿紧紧合拢，且用力一紧一松地咬牙切齿，咬紧时加倍用力，放松时也互不离开，如此反复20次。
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </article>
        <div class="m-actionsheet" id="actionSheet">
            <a href="#" class="actionsheet-item">常规</a>
            <a href="#" class="actionsheet-item">老年养生</a>
            <a href="#" class="actionsheet-item">不通症状</a>
            <a href="#" class="actionsheet-item">糖尿病</a>
            <a href="#" class="actionsheet-item">痛风</a>
            <a href="#" class="actionsheet-item">减肥</a>
            <a href="#" class="actionsheet-item">感冒</a>
            <a href="#" class="actionsheet-item">腰间盘突出</a>
            <a href="#" class="actionsheet-item">痛经</a>
            <a href="#" class="actionsheet-item">脑血栓</a>
            <a href="javascript:;" class="actionsheet-action" id="cancel">取消</a>
        </div>
    </div>
</div>
