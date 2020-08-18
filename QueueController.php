<?php


namespace ignatenkovnikita\queuemanager;


use yii\console\Controller;

class QueueController extends Controller
{

    public function actionClearLaterWeekMonth(){
        $dateTime = new \DateTime();
        $dateTime->modify('-7 days');

        \ignatenkovnikita\queuemanager\models\QueueManager::deleteAll(['<','created_at', $dateTime->getTimestamp()]);

    }


}