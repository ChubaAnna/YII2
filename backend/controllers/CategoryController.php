<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\CategoryForm;
use common\models\Category;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;


class CategoryController extends Controller
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
            'query' => Category::find(),
         ]);
         return $this->render('index', [
            'dataProvider' => $dataProvider 
         ]);
    }

    public function actionCreate()
        {
            $model = new CategoryForm;
            if ($model->load(Yii::$app->request->post()) && $model->validate()){
                   $category = new Category;
                   $category->name = $model->name;
                   $category->description = $model->description;
                //    $promotion->urlImage = $model->imagePath();
                   if ($category->save()){
                    $this->redirect(['category/index']);
                   }
            }

            return $this->render('create', ['model' => $model]);
        }
        public function actionDelete($id)
        {
            $category = Category::findOne(['id' => $id]);
            $category->delete();
            $this->redirect(['category/index']);
        }
        public function actionUpdate($id)
        {
            $model = new CategoryForm;
            $category = Category::findOne(['id' => $id]);
            if ($model->load(Yii::$app->request->post())){
                // $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if($model->upload()){
                    $category->name = $model->name;
                    $category->description = $model->description;
                    // $promotion->urlImage = $model->imagePath();
                    if ($category->save()){
                     $this->redirect(['category/index']);
                    }
                }
            }
            $model->name = $category->name;
            $model->description = $category->description;
            return $this->render('create', ['model' => $model]);
        }
        public function actionView($id)
        {
            $category = Category::findOne(['id' => $id]);
            return $this->render('view', ['category' => $category]);
        }
}
