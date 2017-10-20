<?php

namespace ignatenkovnikita\queuemanager\models;

use Yii;

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
 * @property integer $update_at
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
        return '{{%queue_manager}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ttr', 'delay', 'priority', 'result_id', 'created_at', 'update_at', 'start_execute', 'end_execute'], 'integer'],
            [['properties', 'data', 'result'], 'string'],
            [['name', 'sender', 'status', 'class'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'sender' => Yii::t('app', 'Sender'),
            'ttr' => Yii::t('app', 'Ttr'),
            'delay' => Yii::t('app', 'Delay'),
            'priority' => Yii::t('app', 'Priority'),
            'status' => Yii::t('app', 'Status'),
            'class' => Yii::t('app', 'Class'),
            'properties' => Yii::t('app', 'Properties'),
            'data' => Yii::t('app', 'Data'),
            'result_id' => Yii::t('app', 'Result ID'),
            'result' => Yii::t('app', 'Result'),
            'created_at' => Yii::t('app', 'Created At'),
            'update_at' => Yii::t('app', 'Update At'),
            'start_execute' => Yii::t('app', 'Start Execute'),
            'end_execute' => Yii::t('app', 'End Execute'),
        ];
    }

    /**
     * @inheritdoc
     * @return \ignatenkovnikita\queuemanager\models\query\QueueManagerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \ignatenkovnikita\queuemanager\models\query\QueueManagerQuery(get_called_class());
    }
}
