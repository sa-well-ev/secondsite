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
        $this->setMeta('E-SHOPPER');
        return $this->render('index', compact('hits'));
    }

    public function actionView($id)
    {
        //Непонятно зачем переписывать переменную $id когда она и так приходит из вне в параметре метода
        //$id = Yii::$app->request->get('id');
        $products = Product::find()->where(['category_id' => $id])-> all();
        $category = Category::findOne($id);
        $this->setMeta('E-SHOPPER | ' .$category->name, $category->keywords, $category->description);
        return $this->render('view', compact('products', 'category'));
    }
}
