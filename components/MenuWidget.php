<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 02.05.2018
 * Time: 16:12
 */

namespace app\components;


use yii\base\Widget;

class MenuWidget extends Widget
{
    public $tpl;

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
        return $this ->tpl;
    }
}