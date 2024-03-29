<?php

namespace app\controllers;

use app\models\Movimiento;
use app\models\MovimientoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Producto;
use app\models\Bodega;


/**
 * MovimientoController implements the CRUD actions for Movimiento model.
 */
class MovimientoController extends Controller
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
     * Lists all Movimiento models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MovimientoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Movimiento model.
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
     * Creates a new Movimiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Movimiento();
        $model->fecha=date('Y-m-d H:i');
        $producto = ArrayHelper::map(Producto::find()->all(), 'id', 'nombre');
        $bodega = ArrayHelper::map(Bodega::find()->all(), 'id', 'nombre');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                //en stock hay que buscar la bodega y el producto

                $stock = \app\models\Stock::find()
                    ->where(['bodega_id' => $model->bodega_id, 'producto_id' => $model->producto_id])
                    ->one();

                if(!$stock){ //aqui se supone que no hay del stock en esa bodega, hay que crearlo
                    $stock = new \app\models\Stock();
                    $stock->bodega_id = $model->bodega_id;
                    $stock->producto_id = $model->producto_id;
                    $stock->cantidad = $model->cantidad;
                } else { //en este caso si hay stock, solo hay q actualizarlo
                    if($model->tipo == "INGRESO"){
                        $stock->cantidad = $stock->cantidad + $model->cantidad;
                    } else {
                        $stock->cantidad = $stock->cantidad - $model->cantidad;
                    }
                }

                $stock->save();

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'producto' => $producto,
            'bodega' => $bodega,
        ]);
    }

    /**
     * Updates an existing Movimiento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $producto = ArrayHelper::map(Producto::find()->all(), 'id', 'nombre');
        $bodega = ArrayHelper::map(Bodega::find()->all(), 'id', 'nombre');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'producto' => $producto,
            'bodega' => $bodega,
        ]);
    }

    /**
     * Deletes an existing Movimiento model.
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
     * Finds the Movimiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Movimiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Movimiento::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
