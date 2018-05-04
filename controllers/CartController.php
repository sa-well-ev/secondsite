<?php

namespace app\controllers;
use app\models\Product;
use app\models\Cart;
use Yii;

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
    public function actionAdd(){
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if(empty($product)) return false;
        //работаем с сессией
        $session =Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->addToCart($product);
    }
}