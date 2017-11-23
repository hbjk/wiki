<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = '添加文章';
//$this->params['breadcrumbs'][] = ['label' => 'Test2s', 'url' => ['entry']];
$this->params['breadcrumbs'][] = ['label' => '文章列表', 'url' => ['test/list']];
$this->params['breadcrumbs'][] = '添加文章';
$this->registerJsFile('@web/plugin/UEditor/ueditor.config.js');
$this->registerJsFile('@web/plugin/UEditor/ueditor.all.min.js');

$this->registerCssFile('@web/js/webuploader/webuploader.css');
$this->registerJsFile('@web/js/webuploader/webuploader.min.js');

?>

<style>

    .col-md-6,.col-md-12 {
        padding: 0 10px 20px 10px;
    }
    .w-e-toolbar {
        display: block;
    }
    .w-e-menu {
        display: inline-block;
    }
    .box-footer {
        padding-top: 0;
    }
    .iconfont-d {
        font-size: 28px;
    }
    input[name="checklogo"] {
        margin-left: 20px;
    }
    .sort {
        width: 15%;
    }
</style>

<div class="box box-warning">

    <!-- /.box-header -->
    <div class="box-body">
        <?php $form = ActiveForm::begin([
            'action' => Url::to(['test/add']),
            'options' => ['role'=>'form']
        ]); ?>

            <div class="box-body">
                <?= $form->field($model,'name')->textInput();?>
                <?= $form->field($model,'slug')->textInput();?>
                <?= $form->field($model,'sort')->textInput();?>
                <?= $form->field($model,'cover')->textInput(['id'=>'cover']);?>
                <div class="form-group">
                    <a href="javascript:" class="picker" id="picker">
                        <i class="fa fa-fw fa-file-image-o"></i>
                    </a>
                </div>

                <?= $form->field($model,'check_logo_id')->textInput();?>
                <div class="form-group">
                    <label for="name">分类</label>
                    <?=
                    Select2::widget([
                        'name'=>'WesternCheck[cat_id]',
                        'theme' => Select2::THEME_DEFAULT,
                        'value'=> 1,
                        'data' => $cat
                    ])
                    ?>
                </div>

                <div class="form-group">
                    <label for="name">项目介绍</label>
                    <div>
                        <script id="editor" name="WesternCheck[introduce]" type="text/plain"></script>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <input id="tijiao" type="button" class="btn btn-primary" value="提交" />
            </div>
        <?php ActiveForm::end();?>
    </div>
    <!-- /.box-body -->
</div>

<script>
    seajs.use('init',function(init){
        init.upload('picker',"<?= Url::to(['/uploader/simpleqiniu']);?>",function(d){
            $('#cover').attr('value',d.file_path);
        });
    });
    seajs.use('testList',function(testList){
        testList.addArticle();
    });

</script>

