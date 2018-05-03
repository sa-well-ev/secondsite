<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 03.05.2018
 * Time: 10:37
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;

class CategoryController extends AppController
{
    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        return $this->render('index', compact('hits'));
    }
}