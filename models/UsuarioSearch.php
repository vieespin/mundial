<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;

/**
 * UsuarioSearch represents the model behind the search form of `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'attempts', 'created_at', 'update_at'], 'integer'],
            [['nombre', 'rut', 'username', 'apellido_paterno', 'apellido_materno', 'email', 'fono', 'auth_key', 'password_hash', 'password_reset_token', 'token', 'token_expiration', 'refresh_token', 'refresh_person_id', 'sector', 'calle', 'numero'], 'safe'],
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
        $query = Usuario::find();

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
            'status' => $this->status,
            'attempts' => $this->attempts,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'token_expiration' => $this->token_expiration,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'rut', $this->rut])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'apellido_paterno', $this->apellido_paterno])
            ->andFilterWhere(['like', 'apellido_materno', $this->apellido_materno])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'fono', $this->fono])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'token', $this->token])
            ->andFilterWhere(['like', 'refresh_token', $this->refresh_token])
            ->andFilterWhere(['like', 'refresh_person_id', $this->refresh_person_id])
            ->andFilterWhere(['like', 'sector', $this->sector])
            ->andFilterWhere(['like', 'calle', $this->calle])
            ->andFilterWhere(['like', 'numero', $this->numero]);

        return $dataProvider;
    }
}
