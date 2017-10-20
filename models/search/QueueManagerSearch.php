<?php

namespace ignatenkovnikita\queuemanager\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use ignatenkovnikita\queuemanager\models\QueueManager;

/**
 * QueueManagerSearch represents the model behind the search form about `ignatenkovnikita\queuemanager\models\QueueManager`.
 */
class QueueManagerSearch extends QueueManager
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ttr', 'delay', 'priority', 'result_id', 'created_at', 'update_at', 'start_execute', 'end_execute'], 'integer'],
            [['name', 'sender', 'status', 'class', 'properties', 'data', 'result'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = QueueManager::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'ttr' => $this->ttr,
            'delay' => $this->delay,
            'priority' => $this->priority,
            'result_id' => $this->result_id,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'start_execute' => $this->start_execute,
            'end_execute' => $this->end_execute,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'sender', $this->sender])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'properties', $this->properties])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'result', $this->result]);

        $query->orderBy('created_at DESC');

        return $dataProvider;
    }
}
