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
use yii\web\HttpException;

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
        if (empty($product)) throw new HttpException(404, 'Данный товар отсутствует на сайте');

        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $this->setMeta('E-SHOPPER | ' .$product->name, $product->keywords, $product->description);

        return $this->render('view', compact('product', 'hits'));
    }
}