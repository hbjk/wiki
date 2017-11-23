<?php

use yii\grid\GridView;

?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=> '{items}<div class="text-right tooltip-demo">{pager}</div>',
        'pager'=>[
            //'options'=>['class'=>'hidden']//关闭自带分页
            'firstPageLabel'=>"First",
            'prevPageLabel'=>'Prev',
            'nextPageLabel'=>'Next',
            'lastPageLabel'=>'Last',
        ]])
?>
