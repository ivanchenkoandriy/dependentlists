<?php

use yii\bootstrap4\Html;
?>

<article class="item" data-key="<?= $model->id; ?>">
    <h4 class="title">
        <?= Html::encode($model->brand->name); ?> <?= Html::encode($model->model->name); ?>
    </h4>
</article>