<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Poststatus;

/* @var $this yii\web\View */
/* @var $model common\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?php  // echo $form->field($model, 'author_id'); ?>
    <?php  echo $form->field($model, 'authorName'); ?>

    <?php // echo $form->field($model, 'content'); ?>

    <?= $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 'status'); ?>
    <?php echo $form->field($model, 'status')->dropDownList(
        [Poststatus::find()
            ->select(['name', 'id'])
            ->orderBy('position')
            ->indexBy('id')
            ->column()
        ],
        ['prompt' => '请选择', 'style' => 'width:120px']
    ); ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php  echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton('搜素', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
