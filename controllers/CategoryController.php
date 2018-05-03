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
use yii\data\Pagination;

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

        //Начинаем разбивать по странично - все объекты сразу нам не нужны.
        //$products = Product::find()->where(['category_id' => $id])-> all();

        //Начинаем строить разбивку по страницам
        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 3,
            'forcePageParam' => false,
            'pageSizeParam' => false,
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $category = Category::findOne($id);
        $this->setMeta('E-SHOPPER | ' .$category->name, $category->keywords, $category->description);
        return $this->render('view', compact('products', 'pages', 'category'));
    }
}
