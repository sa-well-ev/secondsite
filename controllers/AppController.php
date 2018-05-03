<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 03.05.2018
 * Time: 10:39
 */

namespace app\controllers;


use yii\web\Controller;

class AppController extends Controller
{
    protected function setMeta($title = null, $keywords = null, $description = null)
    {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'descrption', 'content' => "$description"]);
          }
}