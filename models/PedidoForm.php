<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class PedidoForm extends Model
{
    public $nombre;
    public $sector;
    public $fono;
    public $repartidor;
    public $calle;
    public $numero;
    //public $cliente_id;
    public $medio_pago;
    //public $repartidor_id;
    //public $estado_pedido_id;

 


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['nombre', 'fono', 'calle', 'numero', 'repartidor'], 'required'],
            [['sector', 'repartidor'], 'string'],
            [['repartidor', 'numero'], 'integer'],
            ['fono', 'match', 'pattern' => '/^\+569\d{8}$/', 'message' => 'Ingresar una wea valida'],

            // email has to be a valid email address
            //['email', 'email'],
            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    // /**
    //  * Sends an email to the specified email address using the information collected by this model.
    //  * @param string $email the target email address
    //  * @return bool whether the model passes validation
    //  */
    // public function contact($email)
    // {
    //     if ($this->validate()) {
    //         Yii::$app->mailer->compose()
    //             ->setTo($email)
    //             ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
    //             ->setReplyTo([$this->email => $this->name])
    //             ->setSubject($this->subject)
    //             ->setTextBody($this->body)
    //             ->send();

    //         return true;
    //     }
    //     return false;
    // }
}
