<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Detalle;

/**
 * DetalleSearch represents the model behind the search form of `app\models\Detalle`.
 */
class DetalleSearch extends Detalle
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'valor', 'pedido_id', 'producto_id', 'cantidad'], 'integer'],
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
        $query = Detalle::find();

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
            'valor' => $this->valor,
            'pedido_id' => $this->pedido_id,
            'producto_id' => $this->producto_id,
            'cantidad' => $this->cantidad,
        ]);

        return $dataProvider;
    }
}
