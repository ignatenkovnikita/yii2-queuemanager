<?php

namespace ignatenkovnikita\queuemanager\models\query;

/**
 * This is the ActiveQuery class for [[\ignatenkovnikita\queuemanager\models\QueueManager]].
 *
 * @see \ignatenkovnikita\queuemanager\models\QueueManager
 */
class QueueManagerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \ignatenkovnikita\queuemanager\models\QueueManager[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \ignatenkovnikita\queuemanager\models\QueueManager|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
