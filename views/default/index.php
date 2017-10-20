<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel ignatenkovnikita\queuemanager\models\search\QueueManagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Queue Managers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-manager-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            'sender',
//            'ttr',
//            'delay',
            // 'priority',
            // 'status',
            // 'class',
            // 'properties:ntext',
            // 'data:ntext',
            // 'result_id',
            // 'result:ntext',
            'created_at:datetime',
            // 'update_at',
            'start_execute:datetime',
            'end_execute:datetime',
            [
                'label' => Yii::t('backend', 'Time Execute'),
                'value' => function (\ignatenkovnikita\queuemanager\models\QueueManager $data) {
                    return Yii::$app->formatter->asTimestamp($data->end_execute - $data->start_execute);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
