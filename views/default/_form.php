<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ignatenkovnikita\queuemanager\models\QueueManager */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="queue-manager-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'sender')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'ttr')->textInput() ?>

    <?php echo $form->field($model, 'delay')->textInput() ?>

    <?php echo $form->field($model, 'priority')->textInput() ?>

    <?php echo $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'class')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'properties')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'data')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'result_id')->textInput() ?>

    <?php echo $form->field($model, 'result')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'created_at')->textInput() ?>

    <?php echo $form->field($model, 'update_at')->textInput() ?>

    <?php echo $form->field($model, 'start_execute')->textInput() ?>

    <?php echo $form->field($model, 'end_execute')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('queuemanager', 'Create') : Yii::t('queuemanager', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
