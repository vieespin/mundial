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

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
            return $model->usuario->nombre;
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
    public function actionGenerar($fono, $nombre, $sector, $calle, $numero, $repartidor, $detalle){

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
}
