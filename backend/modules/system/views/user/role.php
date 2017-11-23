<?php

/* @var $this yii\web\View */
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\User;
use app\models\UserForm;
use mdm\admin\components\MenuHelper;


$this->title = '用户列表';
$this->params['breadcrumbs'][] = ['label' => '后台用户'];
$this->params['breadcrumbs'][] = '用户列表';

AppAsset::addCss($this, '@web/css/dataTables.bootstrap.min.css');

\yii\helpers\VarDumper::dump(MenuHelper::getAssignedMenu(Yii::$app->user->id));

?>


