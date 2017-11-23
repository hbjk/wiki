<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;

/* @var $this yii\web\View */
$this->title = '文章编辑';
$this->params['breadcrumbs'][] = ['label' => '文章列表', 'url' => ['test/list']];
$this->params['breadcrumbs'][] = '文章编辑';
$this->registerJsFile('@web/plugin/UEditor/ueditor.config.js');
$this->registerJsFile('@web/plugin/UEditor/ueditor.all.min.js');
$this->registerCssFile('@web/js/webuploader/webuploader.css');
$this->registerJsFile('@web/js/webuploader/webuploader.min.js');
?>
<div class="box box-warning">
    <div class="box-body">
        <?php $form = ActiveForm::begin([
            'action' => Url::to(['test/add']),
            'options' => ['role'=>'form']
        ]); ?>
        <div class="box-body">
            <?= $form->field($model,'name')->textInput(['value'=>Html::encode($model->name)]);?>
            <?= $form->field($model,'slug')->textInput(['value'=>Html::encode($model->slug)]);?>
            <?= $form->field($model,'sort')->textInput(['value'=>Html::encode($model->sort)]);?>
            <?= $form->field($model,'cover')->textInput(['id'=>'cover','value'=>Html::encode($model->cover)]);?>
            <div class="form-group">
                <a href="javascript:" class="picker" id="picker">
                    <i class="fa fa-fw fa-file-image-o"></i>
                </a>
            </div>
            <?= $form->field($model,'check_logo_id')->textInput(['value'=>Html::encode($model->check_logo_id)]);?>
            <div class="form-group">
                <label for="name">分类</label>
                <?=
                Select2::widget([
                    'name'=>'WesternCheck[cat_id]',
                    'theme' => Select2::THEME_DEFAULT,
                    'value'=> $model->cat_id,
                    'data' => $cat
                ])
                ?>
            </div>

            <div class="form-group">
                <label for="name">项目介绍</label>
                <div>
                <script id="editor" name="WesternCheck[introduce]" type="text/plain">
                    <?= $model->introduce ?>
                </script>
                </div>
            </div>
        </div>
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
        testList.editArticle();
    });

    $(function(){
        $('#tijiao').click(function(){
            var data = $("#w0").serialize();
            $.ajax({
                type:'post',
                url:"/test/update?id=<?= Html::encode($model->id) ?>",
                dataType: 'json',
                data: data,
                success: function(d) {
                    if(d.done==true){
                        swal({
                            'title': '修改文章成功',
                            'type': 'success',
                        }, function (isConfirm) {
                            if(isConfirm){
                                window.location.href = "/test/list";
                            }
                        });
                    }else {
                        swal(d.error);
                    }
                }
            });
        });
    });
</script>

