<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Poststatus;
use common\models\Adminuser;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

    <?php
        // 方法一
        /*$psObjs = Poststatus::find()->all();
        $allStatus = \yii\helpers\ArrayHelper::map($psObjs, 'id', 'name');*/
        // 方法二
        /*$psArray = Yii::$app->db->createCommand("SELECT id, name FROM poststatus ORDER BY position ASC")->queryAll();
        $allStatus = \yii\helpers\ArrayHelper::map($psArray, 'id', 'name');*/
        // 方法三  QueryBuild
        /*$allStatus = (new \yii\db\Query())
            ->select(['name','id'])
            ->from('poststatus')
            ->indexBy('id')
            ->column();*/
        // 方法四
        $allStatus = Poststatus::find()
            ->select(['name','id'])
            ->from('poststatus')
            ->indexBy('id')
            ->column();
    ?>
    <?= $form->field($model, 'status')->dropDownList(
        /*[
            1 => '草稿',
            2 => '已发布',
        ],*/
        $allStatus,
        ['prompt' => '请选择状态']
    ); ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'author_id')->dropDownList(
        Adminuser::find()
            ->select(['nickname', 'id'])
            ->orderBy('id')
            ->indexBy('id')
            ->column(),
        ['prompt' => '请选择状态']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
