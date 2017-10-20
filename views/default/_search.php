<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ignatenkovnikita\queuemanager\models\search\QueueManagerSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="queue-manager-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'name') ?>

    <?php echo $form->field($model, 'sender') ?>

    <?php echo $form->field($model, 'ttr') ?>

    <?php echo $form->field($model, 'delay') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'class') ?>

    <?php // echo $form->field($model, 'properties') ?>

    <?php // echo $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'result_id') ?>

    <?php // echo $form->field($model, 'result') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <?php // echo $form->field($model, 'start_execute') ?>

    <?php // echo $form->field($model, 'end_execute') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
