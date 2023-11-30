<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $rut
 * @property string|null $username
 * @property string|null $apellido_paterno
 * @property string|null $apellido_materno
 * @property string|null $email
 * @property string|null $fono
 * @property int|null $status
 * @property int|null $attempts
 * @property string|null $auth_key
 * @property string|null $password_hash
 * @property string|null $password_reset_token
 * @property int|null $created_at
 * @property int|null $update_at
 * @property string|null $token
 * @property string|null $token_expiration
 * @property string|null $refresh_token
 * @property string|null $refresh_person_id
 * @property string|null $sector
 * @property string|null $calle
 * @property string|null $numero
 *
 * @property Repartidor[] $repartidors
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'attempts', 'created_at', 'update_at'], 'integer'],
            [['token_expiration'], 'safe'],
            [['nombre', 'rut', 'username', 'apellido_paterno', 'apellido_materno', 'email', 'fono', 'refresh_person_id', 'sector', 'calle', 'numero'], 'string', 'max' => 45],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['token', 'refresh_token'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'rut' => 'Rut',
            'username' => 'Username',
            'apellido_paterno' => 'Apellido Paterno',
            'apellido_materno' => 'Apellido Materno',
            'email' => 'Email',
            'fono' => 'Fono',
            'status' => 'Status',
            'attempts' => 'Attempts',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'created_at' => 'Created At',
            'update_at' => 'Update At',
            'token' => 'Token',
            'token_expiration' => 'Token Expiration',
            'refresh_token' => 'Refresh Token',
            'refresh_person_id' => 'Refresh Person ID',
            'sector' => 'Sector',
            'calle' => 'Calle',
            'numero' => 'Numero',
        ];
    }

    /**
     * Gets query for [[Repartidors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRepartidors()
    {
        return $this->hasMany(Repartidor::class, ['usuario_id' => 'id']);
    }
}
