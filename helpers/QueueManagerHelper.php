<?php

namespace ignatenkovnikita\queuemanager\helpers;

use ignatenkovnikita\queuemanager\models\QueueManager;
use Yii;
use yii\base\NotSupportedException;
use yii\helpers\VarDumper;
use yii\queue\ExecEvent;
use yii\queue\Job;
use yii\queue\PushEvent;

/**
 * Created by PhpStorm.
 * User: ignatenkovnikita
 * Web Site: http://IgnatenkovNikita.ru
 */
class QueueManagerHelper
{


    private static function parseDate($event)
    {
        $data = [];
        foreach (Yii::$app->getComponents(false) as $id => $component) {
            if ($component === $event->sender) {
                $data['sender'] = $id;
                break;
            }
        }
        $data['id'] = $event->id;
        $data['ttr'] = isset($event->ttr) ? $event->ttr : null;
        $data['delay'] = isset($event->delay) ? $event->delay : null;
        $data['priority'] = isset($event->priority) ? $event->priority : null;
        $data['status'] = self::getStatus($data);
        if ($event->job instanceof Job) {
            $data['class'] = get_class($event->job);
            $data['properties'] = [];
            foreach (get_object_vars($event->job) as $property => $value) {
                $data['properties'][$property] = VarDumper::dumpAsString($value);
            }
        } else {
            $data['data'] = VarDumper::dumpAsString($event->job);
        }

        return $data;
    }

    public static function create(PushEvent $event)
    {
        $model = new \ignatenkovnikita\queuemanager\models\QueueManager();
        $data = self::parseDate($event);
        $model->load($data, '');
        $model->id = $data['id'];
        $model->properties = json_encode($model->properties);
        $model->data = json_encode($model->data);
        $model->created_at = time();
        $r = $model->save();
        return $r;
    }

    public static function startExec(ExecEvent $event)
    {
        $model = QueueManager::findOne($event->id);
        $model->start_execute = time();
        $r = $model->updateAttributes(['start_execute']);
        return $r;
    }

    public static function afterExec(ExecEvent $event)
    {
        $model = QueueManager::findOne($event->id);
        $model->end_execute = time();
        $r = $model->updateAttributes(['end_execute']);
        return $r;
    }

    private static function getStatus($data)
    {
        if ($queue = Yii::$app->get($data['sender'], false)) {
            try {
                if ($queue->isWaiting($data['id'])) {
                    $status = 'waiting';
                } elseif ($queue->isReserved($data['id'])) {
                    $status = 'reserved';
                } elseif ($queue->isDone($data['id'])) {
                    $status = 'done';
                }
            } catch (NotSupportedException $e) {
            } catch (\Exception $e) {
                $status = $e->getMessage();
            }
        }
        return $status;
    }
}