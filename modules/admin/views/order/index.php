<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            'updated_at',
            'qty',
            'sum',
            //'status',
            //Делаем условный вывод поля status
            [
                'attribute' => 'status',
                'value' => function($data)
                {
                    return !$data->status ? '<span class="text-danger">Активный</span>' : '<span class="text-success">Завершён</span>';
                },
                //Для вывода html разметки в ячейке или или
                //'format' => 'raw',
                'format' => 'html',
            ],
            //'name',
            //'email:email',
            //'phone',
            //'address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
