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
        $qty = (int)Yii::$app->request->get('qty');
        //Проверяем число ли то количество что нам передано
        $qty = !$qty ? 1 : $qty;
        $product = Product::findOne($id);
        if(empty($product)) return false;
        //работаем с сессией
        $session =Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->addToCart($product, $qty);

        //Для отрисовки проверяем не AJAX ли это запрос
        if (!Yii::$app->request->isAjax){
          return $this->redirect(Yii::$app->request->referrer);
        };

        $this->layout = false;
        /**Таким вот образом AJAX запрос не может получить ответ методом render поскольку использует шаблон в который
         * включает отрисовку этого запроса, поэтому нужно или использовать renderPartial (отключает шаблон)
         * или renderAjax (отключает шаблон но подгружает необходимые скрипты
         * или отключат шаблон вручну для этого Action (Хотя всё равно всё работает*/
        //return $this->render('cart-modal', ['session' => $session]);
        return $this->render('cart-modal', compact('session'));
    }

    public function actionClear()
    {
        $session =Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        //или очищать шаблон при выводе $this->layout = false
        return $this->renderAjax('cart-modal', compact('session'));
    }

    public function actionDelItem()
    {
        $id = Yii::$app->request->get('id');
        $session =Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionShow()
    {
        $session =Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }
}