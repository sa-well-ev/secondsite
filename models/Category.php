<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 02.05.2018
 * Time: 15:59
 */

namespace app\models;


use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }
}