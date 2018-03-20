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
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Queue Managers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


// status
$data = (new \yii\db\Query())
    ->select(new \yii\db\Expression('DATE_FORMAT(FROM_UNIXTIME(created_at), \'%d-%m-%Y\') AS dd,
  status,
  count(*)as cnt'))
    ->from('queue_manager')
    ->groupBy('status,dd')
    ->orderBy('created_at')
    ->all();

$labels = [];
foreach ($data as $item) {
    $dd = $item['dd'];
    if (!in_array($dd, $labels)) {
        $labels[] = $dd;
    }
}
$status1 = array_fill_keys($labels, '0');
$status1 = array_fill_keys($labels, '0');
$status2 = array_fill_keys($labels, '0');
$status3 = array_fill_keys($labels, '0');
foreach ($data as $item) {
    $dd = $item['dd'];
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