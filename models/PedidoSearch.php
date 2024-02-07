<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pedido;
use kartik\daterange\DateRangeBehavior;

/**
 * PedidoSearch represents the model behind the search form of `app\models\Pedido`.
 */
class PedidoSearch extends Pedido
{

    // public $rango_fecha;
    public $inicio_rango;
    public $fin_rango;


    /**
     * {@inheritdoc}
     */

    
     public function behaviors()
     {
         return [
            [
                 'class' => DateRangeBehavior::className(),
                 'attribute' => 'fecha',
                 'dateStartAttribute' => 'inicio_rango',
                 'dateEndAttribute' => 'fin_rango',
                 'dateStartFormat' => 'Y-m-d H:i',
                 'dateEndFormat' => 'Y-m-d',
            ]
        ];
     }
    public function rules()
    {
        return [
            [['id', 'cliente_id', 'repartidor_id', 'estado_pedido_id'], 'integer'],
            [['fecha', 'nombre', 'sector', 'fono', 'repartidor', 'calle', 'numero', 'inicio_rango', 'fin_rango'], 'safe'],
            // [['fecha'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
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
        $query = Pedido::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'fecha' => $this->fecha,
            'cliente_id' => $this->cliente_id,
            'repartidor_id' => $this->repartidor_id,
            'estado_pedido_id' => $this->estado_pedido_id,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'sector', $this->sector])
            ->andFilterWhere(['like', 'fono', $this->fono])
            ->andFilterWhere(['like', 'repartidor', $this->repartidor])
            ->andFilterWhere(['like', 'calle', $this->calle])
            ->andFilterWhere(['like', 'numero', $this->numero]);

        // $query->andFilterWhere(['between','fecha', '2024-02-06', '2024-02-06 23:59:59']);

        if(isset ($this->inicio_rango) && $this->inicio_rango!='') {
            $query->andFilterWhere(['between','fecha', $this->inicio_rango, $this->fin_rango.' 23:59:59']);
            $this->fecha = date('d-m-Y', strtotime($this->inicio_rango)).' - '.date('d-m-Y', strtotime($this->fin_rango));
        }

        return $dataProvider;
    }
}
