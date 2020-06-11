<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
use app\models\Books;
use app\components\DataType;
use yii\data\ArrayDataProvider;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = Users::findOne(['type' => DataType::DATA_TYPE_USERS]);
    
        if($model === null) {
            $model = new Users();
            $model->data_array = [];
        }
        
        if (Yii::$app->request->post()) {
            if(isset(Yii::$app->request->post()['Users'])) {
                $model->loadFindData(Yii::$app->request->post()['Users']);
                $model->findData();
            }
        }
    
        $data_provider = new ArrayDataProvider([
            'allModels' => $model->data_array,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['id', 'name'],
            ],
        ]);
    
        return $this->render('index', [
            'model' => $model,
            'data_provider' => $data_provider,
        ]);
    }
    
    /**
     * localhost/finance/web/index.php?r=site/set-test-data
     */
    public function actionSetTestData()
    {
        $users = Users::findOne(['type' => DataType::DATA_TYPE_USERS]);
        
        if($users === null) {
            $users = new Users;
            $users->setTestData();
            //$users->printTestData();
            
            $users->type = DataType::DATA_TYPE_USERS;
            //$users->data = 'test';
            if($users->save()) {
                print('Users - data is saved!');
                print('<br>');
            }
            else {
                print_r($users->getErrors());
            }
        }
    
        $books = Books::findOne(['type' => DataType::DATA_TYPE_BOOKS]);
    
        if($books === null) {
            $books = new Books;
            $books->setTestData();
            //$books->printTestData();
    
            $books->type = DataType::DATA_TYPE_BOOKS;
            //$books->data = 'test';
            if($books->save()) {
                print('Books - data is saved!');
                print('<br>');
            }
            else {
                print_r($users->getErrors());
            }
        }
        
    }
    
}
