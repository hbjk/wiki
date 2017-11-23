<?php

/* @var $this yii\web\View */
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\User;
use app\models\UserForm;

$this->title = '用户列表';
$this->params['breadcrumbs'][] = ['label' => '后台用户'];
$this->params['breadcrumbs'][] = '用户列表';

AppAsset::addCss($this, '@web/css/dataTables.bootstrap.min.css');

$this_js = <<<JS

$('.btn-search').click(function(){
    var keyword = $('#userform-search').val();
    var act = $('#user-search').attr('action');
    // swal(act+'/'+keyword);
    window.location.href=act+'/'+keyword;
    return false;
});

JS;
$this->registerJs($this_js);
?>

<div class="row be-user-list">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header" style="top: 10px;">
                <?= Html::a('添加后台用户', ['user/add'],['class'=>'btn bg-orange btn-flat addUser'])?>

                <div class="box-tools" style="top: 10px;">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'user-search',
                        'action' => ['user/list'],
                        'method' => 'GET',
                        'options' => [
                            'class' => 'www'
                        ],
                        'fieldConfig' => [
                            'template' => '{input}'
                        ],
                    ]); ?>
                    <div class="input-group input-group-sm" style="width:220px;">
                    <?= $form->field(new UserForm(), 'search', [
                        'template'=>'{input}',
                        'options'=>[
                            'class'=>'m-form-re',
                        ],
                    ])->textInput([
                        'class' => 'form-control input-md pull-right',
                        'placeholder' => '请输入手机号或者用户名',
                        'name' => 'search',
                        'value'=> "$search"
                    ]); ?>
                        <div class="input-group-btn">
                            <?= Html::submitButton('<i class="fa fa-search"></i>', [
                                'class' => 'btn btn-default btn-search',
                                'template' => '{input}'
                            ]) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end();?>
                </div>
            </div>

            <?php
                echo GridView::widget([
                'dataProvider' => $provider,
                "rowOptions" => function($model, $key, $index, $grid) {
                    return ["class" => $index % 2 ==0 ? "odd" : "even"];
                },
                "tableOptions" =>["class"=>'table table-bordered table-striped dataTable'],
                'summary' => "显示 {begin} - {end} 条记录、 共 {totalCount} 条记录",
                //每列都有搜索框 控制器传过来$searchModel = new ArticleSearch();
                //'filterModel' => $searchModel,
                'layout'=>'
                    <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                {items}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
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
//                    'options'=>['class'=>'hidden'],
                    'firstPageLabel'=>"<<",
                    'prevPageLabel'=>'<',
                    'nextPageLabel'=>'>',
                    'lastPageLabel'=>'>>',
                ],
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],//序列号从1开始
                    // 数据提供者中所含数据所定义的简单的列
                    // 使用的是模型的列的数据
                    'id',
                    'username',
                    'mobile_num',
                    [
                        "label" => "头像",
                        "format" => [
                            "image",
                            [
                                "width"=>"25",
                                "height"=>"25",
                                "class"=>"img-circle"
                            ]
                        ],
                        "value" => function ($model) {
                            return $model->avatar ? $model->avatar : '';
                        },
                    ],
                    'email',
                    [
                        "attribute" => "created_at",
                        "format" => ["date", "php:Y-m-d"],
                    ],
                    [
                        "attribute" => "updated_at",
                        "format" => ["date", "php:Y-m-d"],
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            $showColor = (User::getUserStatus($model->status) == "正常") ? "bg-light-blue" : "bg-red";
                            return Html::label(User::getUserStatus($model->status), '',['class'=>'badge '.$showColor]);
                        },
                        'format' => "raw"
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
//                        'header' => '',
//                        'options' => ['width' => '180px;'],
                        'template' => '{edit} {del}',
                        'buttons' => [
                            'edit' => function ($url, $model) {
                                return Html::input('button', 'userEdit', '编辑',[
                                    'class' => 'btn btn-primary btn-flat btn-sm',
                                    'id' => 'userEdit'
                                ]);
                            },
                            'del' => function(){
                                return Html::input('button', 'userDel', '删除',[
                                    'class' => 'btn btn-danger btn-flat btn-sm'
                                ]);
                            }
                        ],
                    ]
                ],
            ]);
            ?>

            <!-- /.box-body -->
        </div>
    </div>
</div>
<script>
    seajs.use('userlist',function(userlist){
        userlist.load();
    });
</script>