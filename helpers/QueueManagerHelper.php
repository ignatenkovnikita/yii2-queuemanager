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
//        $data['status'] = self::getStatus($data);
        if ($event->job instanceof Job) {
            $data['class'] = get_class($event->job);
            $data['name'] = $event->job->name;
            $data['properties'] = [];
            foreach (get_object_vars($event->job) as $property => $value) {
                $data['properties'][$property] = VarDumper::dumpAsString($value);
            }
        } else {
            $data['data'] = VarDumper::dumpAsString($event->job);
        }

        return $data;
    }

    public static function create($event)
    {
        $data = self::parseDate($event);
        $model = QueueManager::findOne($data['id']);
        if (!$model) {
            $model = new QueueManager();
            $model->load($data, '');
            $model->id = $data['id'];
            $model->status = self::getStatus($model);
            $model->properties = json_encode($model->properties);
            $model->data = json_encode($model->data);
            $model->save();
        }

        return $model;
    }

    public static function startExec(ExecEvent $event)
    {
        $model = self::create($event);
        $model->start_execute = time();
        $model->status = self::getStatus($model);
        $r = $model->updateAttributes(['start_execute', 'status']);
        return $r;
    }

    public static function afterExec(ExecEvent $event)
    {
        $model = self::create($event);
        $model->end_execute = time();
        $model->status = QueueManager::STATUS_DONE;
        $r = $model->updateAttributes(['end_execute', 'status']);
        return $r;
    }

    public static function afterError(ExecEvent $event)
    {
        $model = self::create($event);
        $model->end_execute = time();
        $model->status = QueueManager::STATUS_ERROR;
        $model->result = $event->error;
        $r = $model->updateAttributes(['end_execute', 'status', 'result']);
        return $r;
    }

    private static function getStatus($model)
    {
        if ($queue = Yii::$app->get($model->sender, false)) {
            try {
                if ($queue->isWaiting($model->id)) {
                    $status = QueueManager::STATUS_WAITING;
                } elseif ($queue->isReserved($model->id)) {
                    $status = QueueManager::STATUS_RESERVED;
                } elseif ($queue->isDone($model->id)) {
                    $status = QueueManager::STATUS_DONE;
                }
            } catch (NotSupportedException $e) {
            } catch (\Exception $e) {
                $status = $e->getMessage();
            }
        }
        return $status;
    }
}