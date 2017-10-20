<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model ignatenkovnikita\queuemanager\models\QueueManager */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Queue Manager',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Queue Managers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="queue-manager-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
