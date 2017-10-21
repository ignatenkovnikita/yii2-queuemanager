<?php

namespace ignatenkovnikita\queuemanager\models\generated;

use Yii;

/**
 * This is the model class for table "queue_manager".
 *
 * @property integer $id
 * @property string $name
 * @property string $sender
 * @property integer $ttr
 * @property integer $delay
 * @property integer $priority
 * @property integer $status
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
class QueueManager extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'queue_manager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ttr', 'delay', 'priority', 'status', 'result_id', 'created_at', 'updated_at', 'start_execute', 'end_execute'], 'integer'],
            [['properties', 'data', 'result'], 'string'],
            [['name', 'sender', 'class'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('queuemanager', 'ID'),
            'name' => Yii::t('queuemanager', 'Name'),
            'sender' => Yii::t('queuemanager', 'Sender'),
            'ttr' => Yii::t('queuemanager', 'Ttr'),
            'delay' => Yii::t('queuemanager', 'Delay'),
            'priority' => Yii::t('queuemanager', 'Priority'),
            'status' => Yii::t('queuemanager', 'Status'),
            'class' => Yii::t('queuemanager', 'Class'),
            'properties' => Yii::t('queuemanager', 'Properties'),
            'data' => Yii::t('queuemanager', 'Data'),
            'result_id' => Yii::t('queuemanager', 'Result ID'),
            'result' => Yii::t('queuemanager', 'Result'),
            'created_at' => Yii::t('queuemanager', 'Created At'),
            'updated_at' => Yii::t('queuemanager', 'Updated At'),
            'start_execute' => Yii::t('queuemanager', 'Start Execute'),
            'end_execute' => Yii::t('queuemanager', 'End Execute'),
        ];
    }

    /**
     * @inheritdoc
     * @return QueueManagerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QueueManagerQuery(get_called_class());
    }
}
