<?php

namespace frontend\controllers;

use Yii;
use common\components\MultiLingualController as Controller;
use yii\filters\AccessControl;

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

    // list all, mine
    public function actionIndex()
    {
        return $this->render('index');
    }

    // add new
    public function actionNew()
    {
        return $this->render('new');
    }

    // edit, check it is mine
    public function actionUpdate()
    {
        return $this->render('index');
    }

    // delete
    public function actionDelete()
    {
        return $this->render('index');
    }

}
