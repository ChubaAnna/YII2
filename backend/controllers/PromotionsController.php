<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\PromotionForm;
use common\models\Promotions;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;


class PromotionsController extends Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'create', 'delete', 'update','view'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    // [
                    //     'actions' => ['logout'],
                    //     'allow' => true,
                    //     'roles' => ['ContentManager'],
                    // ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
        
    }
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Promotions::find(),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
        {
            $model = new PromotionForm;
            if ($model->load(Yii::$app->request->post())){
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
               if($model->upload()){
                   $promotion = new Promotions;
                   $promotion->name = $model->name;
                   $promotion->description = $model->description;
                   $promotion->urlImage = $model->imagePath();
                   if ($promotion->save()){
                    $this->redirect(['promotions/index']);
                   }
               }
            }

            return $this->render('create', ['model' => $model]);
        }
        public function actionDelete($id)
        {
            $promotion = Promotions::findOne(['id' => $id]);
            $promotion->delete();
            $this->redirect(['promotions/index']);
        }
        public function actionUpdate($id)
        {
            $model = new PromotionForm;
            $promotion = Promotions::findOne(['id' => $id]);
            if ($model->load(Yii::$app->request->post())){
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if($model->upload()){
                    $promotion->name = $model->name;
                    $promotion->description = $model->description;
                    $promotion->urlImage = $model->imagePath();
                    if ($promotion->save()){
                     $this->redirect(['promotions/index']);
                    }
                }
            }
            $model->name = $promotion->name;
            $model->description = $promotion->description;
            $model->imageFile = $promotion->urlImage;
            return $this->render('create', ['model' => $model]);
        }
        public function actionView($id)
        {
            $promotion = Promotions::findOne(['id' => $id]);
            return $this->render('view', ['promotion' => $promotion]);
        }
}
