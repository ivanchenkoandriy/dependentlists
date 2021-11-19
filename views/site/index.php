<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\widgets\ListView;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?= Yii::t('app', 'Dependent lists'); ?></h1>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-12">
                <h3><?= Yii::t('app', 'Add a car'); ?></h3>
                <?php $form = ActiveForm::begin([
                    'id' => 'addCarForm',
                    'method' => 'post',
                    'action' => Url::toRoute(['site/add-car']),
                    'layout' => 'horizontal'
                ]);
                ?>
                <?= $form->field($adder, 'brand')->widget(Select2::class, [
                    'options' => [
                        'placeholder' => Yii::t('app', 'Search for a brand ...'),
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'ajax' => [
                            'url' => Url::toRoute(['site/load-brands']),
                            'dataType' => 'json',
                        ],
                    ],
                    'pluginEvents' => [
                        "change" => "function(event) { app.setBrandId($(this).select2('val')); }",
                    ],
                ]); ?>
                <?= $form->field($adder, 'model')->widget(Select2::class, [
                    'options' => [
                        'placeholder' => Yii::t('app', 'Search for a model ...'),
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'ajax' => [
                            'url' => Url::toRoute(['site/load-models']),
                            'dataType' => 'json',
                            'data' => new JsExpression("function (params) { params.brandId = app.getBrandId(); return params; }")
                        ],
                    ],
                ]); ?>
                <?php if (Yii::$app->session->hasFlash('form-success')) { ?>
                    <div class="alert alert-success alert-dismissible mt-1" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo Yii::$app->session->getFlash('form-success'); ?>
                    </div>
                <?php } ?>
                <?php if (Yii::$app->session->hasFlash('form-danger')) { ?>
                    <div class="alert alert-danger alert-dismissible mt-1" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo Yii::$app->session->getFlash('form-danger'); ?>
                    </div>
                <?php } ?>
                <button class="btn btn-success">
                    <?= Yii::t('app', 'Add'); ?>
                </button>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h3><?= Yii::t('app', 'Cars'); ?></h3>
                <?= ListView::widget([
                    'options' => [
                        'tag' => 'div',
                        'class' => 'list-wrapper',
                        'id' => 'list-wrapper',
                    ],
                    'dataProvider' => $provider,
                    'viewParams' => [
                        'fullView' => true,
                        'context' => 'main-page',
                    ],
                    'itemView' => '_car',
                ]); ?>
            </div>
        </div>
    </div>
</div>