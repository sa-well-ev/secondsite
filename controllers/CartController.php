<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 04.05.2018
 * Time: 15:49
 */

namespace app\controllers;

use app\models\Product;
use app\models\Cart;
use Yii;

// Описание структуры корзины
/*Array
(
    [1] => Array
    (
        [qty] => QTY
        [name] => NAME
        [price] => PRICE
        [img] => IMG
    )
    [10] => Array
    (
        [qty] => QTY
        [name] => NAME
        [price] => PRICE
        [img] => IMG
    )
)
    [qty] => QTY,
    [sum] => SUM
);*/

class CartController extends AppController
{
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if (empty($product)) return false;
        debug($product);
    }
}