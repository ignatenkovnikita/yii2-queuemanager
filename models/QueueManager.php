<?php

namespace ignatenkovnikita\queuemanager\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%queue_manager}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $sender
 * @property integer $ttr
 * @property integer $delay
 * @property integer $priority
 * @property string $status
 * @property string $class
 * @property string $properties
 * @property string $data
 * @property integer $result_id
 * @property string $result
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $start_execute
 * @property integer $end_execute
 */
class QueueManager extends \ignatenkovnikita\queuemanager\models\generated\QueueManager
{


    const STATUS_WAITING = 1;
    const STATUS_RESERVED = 2;
    const STATUS_DONE = 3;
    const STATUS_ERROR = 4;


    public static function getStatuses($status = false)
    {
        $statuses = [
            self::STATUS_WAITING => Yii::t('queuemanager', 'Status Waiting'),
            self::STATUS_RESERVED => Yii::t('queuemanager', 'Status Reserved'),
            self::STATUS_DONE => Yii::t('queuemanager', 'Status Done'),
            self::STATUS_ERROR => Yii::t('queuemanager', 'Status Error'),
        ];

        return $status ? ArrayHelper::getValue($statuses, $status) : $statuses;
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'timestamp' => \yii\behaviors\TimestampBehavior::class,
        ]);
    }

}
