<?php

namespace ignatenkovnikita\queuemanager\controllers;

use Yii;
use ignatenkovnikita\queuemanager\models\QueueManager;
use ignatenkovnikita\queuemanager\models\search\QueueManagerSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * DefaultController implements the CRUD actions for QueueManager model.
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'repeat' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all QueueManager models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QueueManagerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return array
     */
    protected function getWorkersInfo()
    {
        $queue = Yii::$app->queue;

        $workers = [];
        $data = $queue->redis->clientList();
        foreach (explode("\n", trim($data)) as $line) {
            $client = [];
            foreach (explode(' ', trim($line)) as $pair) {
                list($key, $value) = explode('=', $pair, 2);
                $client[$key] = $value;
            }
            if (isset($client['name']) && strpos($client['name'], $queue->channel . '.worker') === 0) {
                $workers[$client['name']] = $client;
            }
        }

        return $workers;
    }


    public function actionAjax()
    {
        $workers = [];
        if ($workersInfo = $this->getWorkersInfo()) {
            foreach ($workersInfo as $name => $info) {
                $workers[] = $name .' '.$info['addr'];
//                Console::stdout($this->format("- $name: ", Console::FG_YELLOW));
//                Console::output($info['addr']);
            }
        }

        $queue = Yii::$app->queue;
        $prefix = $queue->channel;
        $waiting = $queue->redis->llen("$prefix.waiting");
        $delayed = $queue->redis->zcount("$prefix.delayed", '-inf', '+inf');
        $reserved = $queue->redis->zcount("$prefix.reserved", '-inf', '+inf');
        $total = $queue->redis->get("$prefix.message_id");
        $done = $total - $waiting - $delayed - $reserved;

        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'time' => time(),
            'series_1' => (int)$waiting,
            'series_2' => (int)$delayed,
            'series_3' => (int)$reserved,
            'workers' => $workers
        ];
    }


    public function actionStat()
    {
        return $this->render('stat');
    }

    /**
     * Displays a single QueueManager model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new QueueManager model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QueueManager();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing QueueManager model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing QueueManager model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionRepeat($id)
    {
        $model = $this->findModel($id);


        Yii::$app->{$model->sender}->push(new $model->class(json_decode($model->properties)));
        return $this->redirect(Yii::$app->request->referrer);
//        Yii::$app->components->->push()
//        print_r($model);
    }

    /**
     * Finds the QueueManager model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QueueManager the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QueueManager::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
