<?php
/**
 * Copyright (C) $user$, Inc - All Rights Reserved
 *
 *  <other text>
 * @file        stat.php
 * @author      ignatenkovnikita
 * @date        $date$
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model ignatenkovnikita\queuemanager\models\QueueManager */

$this->title = 'stat';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Queue Managers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\ignatenkovnikita\queuemanager\assets\QueueManagerAsset::register($this);
?>


<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>

<h4>Активные workers</h4>
<div id="workers"></div>

<div id="container" style="height: 400px; min-width: 310px"></div>