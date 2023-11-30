<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Garantia;

/**
 * GarantiaSearch represents the model behind the search form of `app\models\Garantia`.
 */
class GarantiaSearch extends Garantia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pedido_id', 'producto_id', 'repartidor_id'], 'integer'],
            [['fecha'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Garantia::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'pedido_id' => $this->pedido_id,
            'producto_id' => $this->producto_id,
            'repartidor_id' => $this->repartidor_id,
            'fecha' => $this->fecha,
        ]);

        return $dataProvider;
    }
}
