<?php

namespace backend\controllers;

use common\models\Refugee;
use backend\models\RefugeeSearch;
use common\components\MultiLingualController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * RefugeeController implements the CRUD actions for Refugee model.
 */
class RefugeeController extends MultiLingualController
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
     * Lists all Refugee models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RefugeeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Refugee model.
     * @param int $id [L]ID
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
     * Creates a new Refugee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Refugee();

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

    /**
     * Updates an existing Refugee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id [L]ID
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
     * Deletes an existing Refugee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id [L]ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Refugee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id [L]ID
     * @return Refugee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Refugee::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('back.general', 'The requested page does not exist.'));
    }
    
    public function actionSelect2($term = null) {
        $result = [];
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $query = Refugee::find()
                ->where([
        ]);

        if (!empty($term)) {
            $query->andWhere('(name LIKE :term)', [
                'term' => "%$term%",
            ]);
        }

        $query->limit(100);

        $models = $query->orderBy(['id' => SORT_ASC])
                ->all();
        
        $result[] = [
            'id' => '',
            'text' => '-',
        ];

        foreach ($models as $model) {
            $result[] = [
                'id' => $model->id,
                'text' => $model->name,
            ];
        }

        return $result;
    }
}
