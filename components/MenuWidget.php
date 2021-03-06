<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 02.05.2018
 * Time: 16:12
 */

namespace app\components;


use app\models\Category;
use yii\base\Widget;
use Yii;


class MenuWidget extends Widget
{
    public $tpl;
    public $model;
    public $data;
    public $tree;
    public $menuHtml;

    public function init()
    {
        parent::init();
        if ($this->tpl === null){
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }

    public function run()
    {
        //Включаем кэширование только для шаблона меню
        if ($this->tpl == 'menu.php') {
            //Проверяем есть что то в кэше.
            $menu = Yii::$app->cache->get('menu');
            if ($menu) return $menu;
        }
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);

        //Запишем меню в кэщ
        //Включаем кэширование только для шаблона меню
        if ($this->tpl == 'menu.php') {
            Yii::$app->cache->set('menu', $this->menuHtml, 60);
        }
        return $this ->menuHtml;
    }

    /**Ядро иерархического списка. Просто гениальная придумка Tommy Lacroix - php design pattern building a tree
     *Он не стал использовать рекурсию а придумал использовать ссыллки на переменные.
     *Он просто забивавет в массив корневые элементы, но делает это не копированием значения переменной,
     * а присвоение ссылки на строку массива.
     * А дальше по ходу цикла он добавляет в элемент массива дочерние элементы если их находит.
     * Гениальность в том, что так как возвращаемый массив содерижит ссылки на элементы, то при их изменении меняется и
     * возвращаемый массив - вот и получилась иерархия.
     */
    protected function getTree(){
        $tree = [];
        foreach ($this->data as $id=>&$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }

    //Переменная tab нужна для формирования отступов в списке категорий
    protected function getMenuHtml($tree , $tab = ''){
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category, $tab);
        }
        return $str;
    }

    //Переменная tab нужна для формирования отступов в списке категорий
    protected function catToTemplate($category, $tab){
        /**Чтобы include шаблон не выводился в браузер происходит его буферизация.
         хотя в шаблоне можно было весь вывод присвоить переменной и просто вернуть её, но это неудобно*/
        ob_start();
        //включаем сюда код шаблона, как будто он был написан здесь.
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        //возврат того что набуферизировали.
        return ob_get_clean();
    }
}