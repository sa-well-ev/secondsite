<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php $img = $model->getImage(); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'name',
            //'content:ntext',
            'content:html',
            'price',
            'keywords',
            'description',
            //'img',
            [
                'attribute' => 'image',
                //'value' => $img->getPathToOrigin(),
                /* Строка ниже выдавала вместо пути к action какую то лабуду. Победить это получилось изменив код модуля yii2-image
                 * в модели vendor/costa-rico/yii2-images/models/Image.php в методе getUrl()
                 * строку '/'.$this->getPrimaryKey().'/images/image-by-item-and-alias',
                 * заменили на
                 * строку '/'.$this->getModule()->id.'/images/image-by-item-and-alias',
                 *
              */
                'value' => '<img src="' . $img->getUrl(). '">',
                'format' => 'html',
            ],
            'hit',
            'new',
            'sale',
        ],
    ]) ?>

</div>
