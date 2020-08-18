<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model ignatenkovnikita\queuemanager\models\QueueManager */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('queuemanager', 'Queue Managers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-manager-view">

    <p>
        <?php echo Html::a(Yii::t('queuemanager', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a(Yii::t('queuemanager', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('queuemanager', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'sender',
            'ttr',
            'delay',
            'priority',
            'status',
            'class',
            'properties:ntext',
            'data:ntext',
            'result_id',
            'result:ntext',
            'created_at:datetime',
            'updated_at:datetime',
            'start_execute:datetime',
            'end_execute:datetime',
        ],
    ]) ?>

</div>
