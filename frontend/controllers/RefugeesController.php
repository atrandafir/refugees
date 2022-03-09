<?php

namespace frontend\controllers;

use Yii;
use common\components\MultiLingualController as Controller;
use yii\filters\AccessControl;
use common\models\Refugee;
use yii\web\NotFoundHttpException;

class RefugeesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $models=Refugee::find()->where([
            'user_id'=>Yii::$app->user->id,
        ])->all();
        return $this->render('index', compact('models'));
    }

    public function actionNew()
    {
        $model = new Refugee();
        $model->user_id=Yii::$app->user->id;
        $model->lang=Yii::$app->language;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('front.refugees', 'Information added correctly.'));
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('new', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('front.refugees', 'Information updated correctly.'));
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    protected function findModel($id)
    {
        $model = Refugee::findOne(['id' => $id]);
        
        if ($model && $model->user_id==Yii::$app->user->id) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('front.general', 'The requested page does not exist.'));
    }

}
