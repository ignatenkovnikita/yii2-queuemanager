<?php

namespace ignatenkovnikita\queuemanager\behaviors;

use ignatenkovnikita\queuemanager\helpers\QueueManagerHelper;
use ignatenkovnikita\queuemanager\models\QueueManager;
use Yii;
use yii\base\Behavior;
use yii\queue\Job;
use yii\queue\ExecEvent;
use yii\queue\JobEvent;
use yii\queue\PushEvent;
use yii\queue\Queue;

class QueueManagerBehavior extends Behavior
{
    /**
     * @var Queue
     */
    public $owner;
    /**
     * @var bool
     */
    public $autoFlush = true;

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            Queue::EVENT_AFTER_PUSH => 'afterPush',
            Queue::EVENT_BEFORE_EXEC => 'beforeExec',
            Queue::EVENT_AFTER_EXEC => 'afterExec',
            Queue::EVENT_AFTER_ERROR => 'afterError',
        ];
    }

    public function afterPush(PushEvent $event)
    {
        QueueManagerHelper::create($event);
    }

    public function beforeExec(ExecEvent $event)
    {
        QueueManagerHelper::startExec($event);
    }

    public function afterExec(ExecEvent $event)
    {
        QueueManagerHelper::afterExec($event);
    }

    public function afterError(ExecEvent $event)
    {
        QueueManagerHelper::afterError($event);

        Yii::endProfile($this->getEventTitle($event), Queue::class);
        Yii::error($this->getEventTitle($event) . ' error ' . $event->error, Queue::class);
        if ($this->autoFlush) {
            Yii::getLogger()->flush(true);
        }
    }

    protected function getEventTitle(JobEvent $event)
    {
        $title = strtr('[id] name', [
            'id' => $event->id,
            'name' => $event->job instanceof Job ? get_class($event->job) : 'mixed data',
        ]);
        if ($event instanceof ExecEvent) {
            $title .= " (attempt: $event->attempt)";
        }

        return $title;
    }
}