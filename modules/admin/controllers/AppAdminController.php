<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 08.05.2018
 * Time: 19:43
 */

namespace app\modules\admin\controllers;


use yii\web\Controller;
use yii\filters\AccessControl;

class AppAdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'allow' => true,
                        'roles' => ['@'],
                        ]
                    ],
                ],
            ];
    }
}