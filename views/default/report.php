<?php
/**
 * Copyright (C) $user$, Inc - All Rights Reserved
 *
 *  <other text>
 * @file        report.php
 * @author      ignatenkovnikita
 * @date        $date$
 */

use dosamigos\chartjs\ChartJs;
use ignatenkovnikita\queuemanager\models\QueueManager;

/**
 * Created by PhpStorm.
 * User: ignatenkovnikita
 * Web Site: http://IgnatenkovNikita.ru
 */

$this->title = 'Report status job';
$this->params['breadcrumbs'][] = ['label' => Yii::t('queuemanager', 'Queue Managers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


// status
$db = Yii::$app->db;
switch ($db->driverName) {
    case 'pgsql':
        $selectExpression = "to_char(to_timestamp(created_at), 'YYYY-MM-DD')";
        break;
    default:
    case 'mysql':
        $selectExpression = "DATE_FORMAT(FROM_UNIXTIME(created_at), '%Y-%m-%d')";
        break;
}
$subQuery = (new \yii\db\Query())
    ->select([
        'dd' => new \yii\db\Expression($selectExpression),
        'status',
    ])->from('queue_manager');
$data = (new \yii\db\Query())
    ->select([
        'dd',
        'status',
        'cnt' => 'COUNT(*)',
    ])
    ->from(['q' => $subQuery])
    ->groupBy(['status', 'dd'])
    ->orderBy('dd')
    ->all();

$labels = [];
foreach ($data as $item) {
    $dd = Yii::$app->formatter->asDate($item['dd']);
    if (!in_array($dd, $labels)) {
        $labels[] = $dd;
    }
}
$status1 = array_fill_keys($labels, '0');
$status2 = array_fill_keys($labels, '0');
$status3 = array_fill_keys($labels, '0');
$status4 = array_fill_keys($labels, '0');
foreach ($data as $item) {
    $dd = Yii::$app->formatter->asDate($item['dd']);
    if ($item['status'] == QueueManager::STATUS_WAITING) {
        $status1[$dd] = $item['cnt'];
    }
    if ($item['status'] == QueueManager::STATUS_RESERVED) {
        $status2[$dd] = $item['cnt'];
    }
    if ($item['status'] == QueueManager::STATUS_DONE) {
        $status3[$dd] = $item['cnt'];
    }
    if ($item['status'] == QueueManager::STATUS_ERROR) {
        $status4[$dd] = $item['cnt'];
    }
}
$status1 = array_values($status1);
$status2 = array_values($status2);
$status3 = array_values($status3);
$status4 = array_values($status4);


echo ChartJs::widget([
    'type' => 'line',
    'options' => [
//        'height' => 400,
//        'width' => 400
    ],
    'data' => [
        'labels' => $labels,
        'datasets' => [
            [
                'label' => "Status Waiting",
//                'backgroundColor' => "rgba(179,181,198,0.2)",
                'borderColor' => "blue",
//                'pointBackgroundColor' => "rgba(179,181,198,1)",
//                'pointBorderColor' => "#fff",
//                'pointHoverBackgroundColor' => "#fff",
//                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => $status1
            ],
            [
                'label' => "Status Reserved",
//                'backgroundColor' => "rgba(255,99,132,0.2)",
                'borderColor' => "green",
//                'pointBackgroundColor' => "rgba(255,99,132,1)",
//                'pointBorderColor' => "#fff",
//                'pointHoverBackgroundColor' => "#fff",
//                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                'data' => $status2
            ],
            [
                'label' => "Status Done",
//                'backgroundColor' => "rgba(255,99,132,0.2)",
                'borderColor' => "green",
//                'pointBackgroundColor' => "rgba(255,99,132,1)",
//                'pointBorderColor' => "#fff",
//                'pointHoverBackgroundColor' => "#fff",
//                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                'data' => $status3
            ],
            [
                'label' => "Status Error",
//                'backgroundColor' => "rgba(255,99,132,0.2)",
                'borderColor' => "red",
//                'pointBackgroundColor' => "rgba(255,99,132,1)",
//                'pointBorderColor' => "#fff",
//                'pointHoverBackgroundColor' => "#fff",
//                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                'data' => $status4
            ]
        ]
    ]
]);