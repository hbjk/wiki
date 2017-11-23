<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;


$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php AppAsset::addScript($this, '@web/js/icheck.min.js'); ?>
<?php
$this_js = <<<JS

$(function () {
    $('.be_remeber').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
});

JS;
$this->registerJs($this_js);
?>
<div class="login-box">

    <div class="login-logo">
        <a href="javascript:;"><b>YII</b>DW</a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">账户登录</p>

        <?php
            $form = ActiveForm::begin([
                'id' => 'login-form',
                'action' => ['be/login'],
//                'enableAjaxValidation' => true,
//                'validateOnSubmit' => true,
//                'validateOnChange'=> false,
//                'validateOnBlur' => false,
//                'validationUrl' => ['be/login_validate'],
//                'options'=> ['class'=>'form-login has-feedback'],

            ]);

        ?>
        <div class="has-feedback">
            <?= $form->field($model, 'username', [
                'template' => "{input}\n<span class='glyphicon glyphicon-envelope form-control-feedback'></span>\n{error}"
            ])->textInput(['autofocus' => true, 'autocomplete' => 'off', 'placeholder'=>'用户名／手机']) ?>
        </div>
        <div class="has-feedback">
            <?= $form->field($model, 'password', [
                'template' => "{input}\n<span class='glyphicon glyphicon-lock form-control-feedback'></span>\n{error}"
            ])->passwordInput(['placeholder'=>'密码']) ?>
        </div>

        <?php if($model->scenario == 'captchaRequired'){ ?>
        <div class="has-feedback">
            <?= $form->field($model, 'verifyCode')->label(false)->widget(Captcha::className(), [
                'captchaAction' => 'be/captcha',
                'template' => '<div class="row"><div class="col-md-6" style="padding: 0 0 0 15px;">{input}</div><div class="col-md-6">{image}</div></div>',
                'imageOptions' => ['id'=>'captchaLogin', 'title' => '换一个', 'alt' => '点击刷新验证码', 'style' => 'cursor:pointer;'],
                'options' => [
                    'id' => 'loginform-verifycode',
                    'class' => 'form-control',
                    'placeholder' => '验证码',
                    'autocomplete' => 'off',
                ],
            ]); ?>
        </div>
        <?php } ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'class'=>'be_remeber',
                    'label'=>'记住一周',
                    'template' => "<div class='checkbox icheck'>{input}</div>"
                ]) ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <!--密码输入错误大于3次，出现验证码-->
            </div>
            <!-- /.col -->
        </div>
        <div class="form-group has-feeback">
            <?= Html::submitButton('登陆', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end();?>

        <!-- /.social-auth-links -->

        <div class="row">
            <div class="col-xs-6">
                <?= Html::a('忘记密码', ['be/request-password-reset']) ?>
            </div>
            <div class="col-xs-6 text-right">
                <?= Html::a('立刻注册', ['be/register']) ?>
            </div>
        </div>


    </div>
    <!-- /.login-box-body -->
</div>
