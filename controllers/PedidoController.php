<?php

namespace app\controllers;

use app\models\Pedido;
use app\models\PedidoForm;
use app\models\Cliente;
use app\models\Producto;

use app\models\PedidoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\MedioPago;
use app\models\Repartidor;
use yii\helpers\ArrayHelper;

/**
 * PedidoController implements the CRUD actions for Pedido model.
 */
class PedidoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Pedido models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PedidoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider -> sort->defaultOrder = ['id' => SORT_DESC];

        $medioPago = ArrayHelper::map(MedioPago::find()->all(), 'id', 'nombre');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'medio_pago' => $medioPago,
        ]);
    }

    /**
     * Displays a single Pedido model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pedido model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pedido();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionNewPedido()
    {
        $model = new PedidoForm();
        $medioPago = ArrayHelper::map(MedioPago::find()->all(), 'id', 'nombre');
        $producto = ArrayHelper::map(Producto::find()->all(), 'id', 'nombre');
        $repartidores = ArrayHelper::map(Repartidor::find()->all(), 'id', function($model){
            return $model->usuario->username;
        });
        $realizados = Pedido::find()->count();

        if ($model->load($this->request->post()) && $model->validate()) {
            

            $cliente = Cliente::find()->where(['fono'=>$model->fono])->one();
            if($cliente){
                //si existe, actualizo datos
                $cliente->nombre = $model->nombre;
                $cliente->sector = $model->sector;
                $cliente->calle = $model->calle;
                $cliente->numero = $model->numero;
                
                
            }
            else{
                //sino lo creo 
                $cliente = new Cliente();
                $cliente->nombre = $model->nombre;
                $cliente->fono = $model->fono;
                $cliente->sector = $model->sector;
                $cliente->calle = $model->calle;
                $cliente->numero = $model->numero;
                
            }

            $cliente->save();

            $pedido = new Pedido();

            $pedido->nombre = $model->nombre;
            $pedido->fono = $model->fono;
            $pedido->sector = $model->sector;
            $pedido->calle = $model->calle;
            $pedido->numero = $model->numero;
            $pedido->fecha = date('Y-m-d H:i');
            $pedido->observacion = $model->observacion;


            $pedido->cliente_id = $cliente->id;
            $pedido->repartidor_id = $model->repartidor;
            $pedido->estado_pedido_id = 1;

            $pedido->save();

            return $this->redirect(['index']);



        }

        return $this->render('new-pedido', [
            'model' => $model,
            'medioPago' => $medioPago,
            'repartidores' => $repartidores,
            'producto' => $producto,
            'realizados' => $realizados,
        ]);

    }
    public function actionGenerar($fono, $nombre, $sector, $calle, $numero, $observacion, $repartidor, $detalle){

        $guardado = false;


        $cliente = Cliente::find()->where(['fono'=>$fono])->one();
        if($cliente){
            //si existe, actualizo datos
            $cliente->nombre = $nombre;
            $cliente->sector = $sector;
            $cliente->calle = $calle;
            $cliente->numero = $numero;
                
                
        }else{
            //sino lo creo 
            $cliente = new Cliente();
            $cliente->nombre = $nombre;
            $cliente->fono = $fono;
            $cliente->sector = $sector;
            $cliente->calle = $calle;
            $cliente->numero = $numero;

            
        }

        $cliente->save();

        $pedido = new Pedido();

        $pedido->nombre = $nombre;
        $pedido->fono = $fono;
        $pedido->sector = $sector;
        $pedido->calle = $calle;
        $pedido->numero = $numero;
        $pedido->fecha = date('Y-m-d H:i');
        $pedido->observacion = $observacion;
        $pedido->repartidor_id = $repartidor;


        $pedido->cliente_id = $cliente->id;
        //$pedido->repartidor_id = $model->repartidor;
        $pedido->estado_pedido_id = 1;

        // if(!$pedido -> save()){
        //     print_r ($pedido->getErrors());
        //     die;
        // }

        $pedido->save();

        if($pedido->save()){
            $guardado = true;
        }

        $detalles= explode("-", $detalle);
        foreach ($detalles as $detalle) {
            $producto_cantidad = explode(",", $detalle);
            $producto = (int)$producto_cantidad[0];
            $cantidad = (int)$producto_cantidad[1];

            $actual = \app\models\Producto::findOne($producto);

            $detalle = new \app\models\Detalle();
            $detalle->producto_id = $producto;
            $detalle->cantidad = $cantidad;
            $detalle->pedido_id = $pedido->id;
            $detalle->valor = $actual->valor*$cantidad;

            $detalle->save();

        }
        
        return $this->asJson(['respuesta'=> $guardado]);

        

    }


    /**
     * Updates an existing Pedido model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pedido model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Pedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pedido::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionPagar($id)
    {
        $pedido = $this->findModel($id);
        $pedido->estado_pedido_id = 3;
        $pedido->save();

        $pago = new \app\models\Pago();

        $pago->monto = $pedido->getTotal();//pedido->total
        $pago->fecha=date('Y-m-d H:i');
        $pago->pedido_id = $id;
        $pago->medio_pago_id = 1;

        $pago->save();

        //buscar el detalle y descontar del stock de acuerdo
        //a la bodega dondde esta asociado el repartidor del pedido

        // buscar la bodega del repartidor

        $bodega = \app\models\Bodega::find()->where(['repartidor_id' => $pedido->repartidor_id])->one();

        foreach ($pedido->detalles as $detalle) {
            // buscar el stock y descontar
            $stock = \app\models\Stock::find()
                ->where([
                    'producto_id' => $detalle->producto_id,
                    'bodega_id' => $bodega->id,
                    ])
                ->one();
            
            $stock->cantidad = $stock->cantidad - $detalle->cantidad;
            $stock->save();
            
        }

        return $this->redirect(['index']);

    }

    public function actionPagarPedido($id, $detalles){

        $pedido = $this->findModel($id);
        $pedido->estado_pedido_id = 3;
        $pedido->save();

        $detalle= explode("-", $detalles);
        foreach ($detalle as $tupla) {
            $forma_monto = explode(",", $tupla);
            $forma = (int)$forma_monto[0];
            $monto = (int)$forma_monto[1];

            $pago = new \app\models\Pago();

            $pago->monto = $monto;
            $pago->fecha=date('Y-m-d H:i');
            $pago->pedido_id = $id;
            $pago->medio_pago_id = $forma;

            $pago->save();
        }

        $bodega = \app\models\Bodega::find()->where(['repartidor_id' => $pedido->repartidor_id])->one();

        foreach ($pedido->detalles as $detalle) {
            // buscar el stock y descontar
            $stock = \app\models\Stock::find()
                ->where([
                    'producto_id' => $detalle->producto_id,
                    'bodega_id' => $bodega->id,
                    ])
                ->one();
            
            $stock->cantidad = $stock->cantidad - $detalle->cantidad;
            $stock->save();
            
        }
        return true;
    }

    public function actionDetalle($id){

        $pedido = $this->findModel($id);

        $medioPago = ArrayHelper::map(MedioPago::find()->all(), 'id', 'nombre');

        return $this->renderAjax('_detalle', [
            'pedido' => $pedido,
            'medio_pago' => $medioPago,
        ]);
    }

    public function actionDetalleFactura($id){

        $pedido = $this->findModel($id);

        $pago = new \app\models\Pago();

        $pago->fecha = date('Y-m-d H:i');
        $pago->monto = $pedido->total;
        $pago->pedido_id = $pedido->id;
        $pago->medio_pago_id = 7; //Ese es el ID de factura

        if ($pago->load($this->request->post()) && $pago->validate()) {
            $pago->save();

            $pedido->estado_pedido_id = 3;
            $pedido->save();

            $bodega = \app\models\Bodega::find()->where(['repartidor_id' => $pedido->repartidor_id])->one();

            foreach ($pedido->detalles as $detalle) {
                // buscar el stock y descontar
                $stock = \app\models\Stock::find()
                    ->where([
                        'producto_id' => $detalle->producto_id,
                        'bodega_id' => $bodega->id,
                        ])
                    ->one();
                
                $stock->cantidad = $stock->cantidad - $detalle->cantidad;
                $stock->save();
                
            }
            return $this->redirect(['index']);
        }

        return $this->renderAjax('_detalle-factura', [
            'pedido' => $pedido,
            'pago' => $pago,
        ]);
    }

    public function actionFactura($id){
        $factura = new \app\models\Factura();

        $factura->pedido_id = $id;

        //Validación mediante ajax
        if ($factura->load($this->request->post()) && $this->request->isAjax){
            $this->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($factura);
        }

        if ($factura->load($this->request->post()) && $factura->validate()) {
            $factura->save();

            return $this->redirect(['index']);
        }

        return this->renderAjax('_factura', [
            'factura' => $factura,
        ]);
    }
}
