<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '华本健康';
?>

<div class="m-grids-4">
    <?php foreach ($testdatas as $data): ?>
        <a href="<?php echo Url::to(['testen/page', 'id' => $data->id]); ?>" class="grids-item">
            <div class="grids-icon">
                <i class="iconfont-d dicon-<?= Html::encode($data->checkLogo->check_logo) ?>"></i>
            </div>
            <div class="grids-txt"><span><?= Html::encode($data->name) ?></span></div>
        </a>
    <?php endforeach; ?>
</div>