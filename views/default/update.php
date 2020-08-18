<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model ignatenkovnikita\queuemanager\models\QueueManager */

$this->title = Yii::t('queuemanager', 'Update {modelClass}: ', [
    'modelClass' => 'Queue Manager',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('queuemanager', 'Queue Managers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('queuemanager', 'Update');
?>
<div class="queue-manager-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
