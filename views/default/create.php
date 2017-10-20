<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model ignatenkovnikita\queuemanager\models\QueueManager */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Queue Manager',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Queue Managers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-manager-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
