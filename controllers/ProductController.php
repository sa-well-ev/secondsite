<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 03.05.2018
 * Time: 18:31
 */

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;

class ProductController extends AppController
{
    public function actionView($id)
    {
        //Опять он зачем то переписывает переменную которая и так приходит из параметра вызова метода
        //$id = Yii::$app->request->get('id');

        //Забирать данные (вместе с таблицей категории) можно двумя способами
        //Первая, жадная загрузка
        //$products = Product::find()->with('category')->where(['id' => $id])->limit(1)->one();
        //Ленивая загрузка
        $product = Product::findOne($id);

        return $this->render('view', compact('product'));
    }
}