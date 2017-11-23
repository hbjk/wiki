<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->context->layout='main-login';
?>
<section class="content">
    <div class="error-page error-404">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
            <h3>
                <i class="fa fa-warning text-yellow"></i>
                <?= nl2br(Html::encode($message)) ?>
            </h3>
            <p>
                <?= nl2br(Html::a('返回','javascript:history.back(-1);')) ?>
            </p>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
    <div>
</section>
