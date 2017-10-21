<?php

namespace ignatenkovnikita\queuemanager\models\generated;

/**
 * This is the ActiveQuery class for [[QueueManager]].
 *
 * @see QueueManager
 */
class QueueManagerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return QueueManager[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return QueueManager|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
