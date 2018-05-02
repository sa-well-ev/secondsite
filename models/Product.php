<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 02.05.2018
 * Time: 16:05
 */

namespace app\models;


use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'product';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}