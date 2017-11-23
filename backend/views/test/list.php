<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = '文章列表';
$this->params['breadcrumbs'][] = '文章列表';

$this_js = <<<JS

seajs.use('testList',function(testList){
        testList.load();
    });

JS;
$this->registerJs($this_js);
?>
<div class="row be-user-list">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header" style="top: 10px;">
                <div class="row">
                    <div class="col-sm-10">
                        <?= Html::a('添加文章', ['test/add'],['class'=>'btn bg-orange btn-flat addUser'])?>
                    </div>
                    <div class="col-sm-2">
                        <?php $from = ActiveForm::begin(); ?>
                        <?=
                        Select2::widget([
                            'name'=>'cat',
                            'theme' => Select2::THEME_DEFAULT,
                            'value'=> $cat_id,
                            'data' => $cat
                        ])
                        ?>
                        <?php ActiveForm::end();?>
                    </div>
                </div>
            </div>

            <?php
                echo GridView::widget([
                    'dataProvider' => $provider,
                    'columns' => [
                        [
                            'label' => 'ID',
                            'value' => 'id',
                            'options' => [
                                'width' => 32
                            ]
                        ],
                        [
                            'label' => '标题',
                            'value' => 'name',
                        ],
                        [
                            'label' => '描述',
                            'value' => function($data) {
                                if(strlen($data->slug) > 10)
                                {
                                    return mb_substr($data->slug,0,10,"UTF8") . '..';
                                }
                                else
                                {
                                    return $data->slug;
                                }
                            },
                            'options' => [
                                'width' => 180,
                            ]
                        ],
                        [
                            'label' => '所属分类',
                            'value' => 'cat.cname',
                            'options' => [
                                'width' => 80
                            ]
                        ],
                        [
                            'label' => 'Icon',
                            'value' => 'check_logo_id',
                        ],
                        [
                            'label' => 'Cover',
                            'format' => 'raw',
                            'value' => function($m){
                                return $m->cover ? Html::img(Yii::$app->params['qiniu']['hbpublic']['url'].$m->cover.'?imageView2/2/w/50') : '未设置';
                            },
                            'options' => [
                                'width' => 60
                            ]

                        ],
                        [
                            'label' => 'Views',
                            'value' => 'views',
                        ],
                        [
                            'label' => '排序',
                            'format' => 'raw',
                            'value' => function($m){
                                return Html::input('text','testId',$m->sort,['id'=>$m->id, 'class'=>'w36 centered', 'd-act'=>'/test/list']);
                            }
                        ],
                        [
                            'label' => '添加时间',
                            'attribute' => 'created_at',
                            "format" => ["date", "php:Y-m-d"],
                        ],
                        [
                            'label' => '修改时间',
                            'attribute' => 'updated_at',
                            "format" => ["date", "php:Y-m-d"],
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {del}',
                            'buttons' => [
                                'update' => function ($url,$model,$key) {
                                    return Html::a('编辑', $url, ['class'=>'btn btn-primary btn-sm']);
                                },
                                'del' => function($url,$model,$key){
                                    return Html::a('删除', 'javascript:;', ['class'=>'btn btn-danger btn-sm','data'=>$url]);
                                }
                            ],
                        ]
                    ],
                    "rowOptions" => function($model, $key, $index, $grid) {
                        return ["class" => $index % 2 ==0 ? "odd" : "even"];
                    },
                    "tableOptions" =>["class"=>'table table-bordered table-striped dataTable'],
                    'summary' => "显示 {begin} - {end} 条记录、 共 {totalCount} 条记录",
                    'layout'=>'
                                <div class="box-body">
                                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            {items}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="dataTables_info" id="page_info">
                                                {summary}
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                                {pager}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            ',
                    'pager'=>[
                        'firstPageLabel'=>"<<",
                        'prevPageLabel'=>'<',
                        'nextPageLabel'=>'>',
                        'lastPageLabel'=>'>>',
                    ],
                ]);
            ?>
        </div>
    </div>
</div>
