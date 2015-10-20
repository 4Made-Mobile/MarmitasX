<?php

namespace app\controllers;

use Yii;
use app\models\PedidoCardapio;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PedidoCardapioController implements the CRUD actions for PedidoCardapio model.
 */
class PedidoCardapioController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create', 'delete', 'update', 'index','view'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all PedidoCardapio models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => PedidoCardapio::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PedidoCardapio model.
     * @param integer $id_pedido
     * @param integer $id_cardapio
     * @return mixed
     */
    public function actionView($id_pedido, $id_cardapio) {
        return $this->render('view', [
                    'model' => $this->findModel($id_pedido, $id_cardapio),
        ]);
    }

    /**
     * Creates a new PedidoCardapio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PedidoCardapio();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_pedido' => $model->id_pedido, 'id_cardapio' => $model->id_cardapio]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PedidoCardapio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_pedido
     * @param integer $id_cardapio
     * @return mixed
     */
    public function actionUpdate($id_pedido, $id_cardapio) {
        $model = $this->findModel($id_pedido, $id_cardapio);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_pedido' => $model->id_pedido, 'id_cardapio' => $model->id_cardapio]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PedidoCardapio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_pedido
     * @param integer $id_cardapio
     * @return mixed
     */
    public function actionDelete($id_pedido, $id_cardapio) {
        $this->findModel($id_pedido, $id_cardapio)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PedidoCardapio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_pedido
     * @param integer $id_cardapio
     * @return PedidoCardapio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_pedido, $id_cardapio) {
        if (($model = PedidoCardapio::findOne(['id_pedido' => $id_pedido, 'id_cardapio' => $id_cardapio])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
