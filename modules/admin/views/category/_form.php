<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">
    <?php //debug($model)?>

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'parent_id')->textInput(['maxlength' => true]) ?>
    <!--Раскрывающийся список-->
    <!--Вариант 1-->
    <?php //echo $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(\app\modules\admin\models\Category::find()->all(), 'id', 'name')) ?>
    <!--Вариант 2-->
    <div class="form-group field-category-parent_id has-success">
        <label class="control-label" for="category-parent_id">Родительская категория</label>
        <select id="category-parent_id" class="form-control" name="Category[parent_id]">
            <option value="0">Корневая категория</option>
            <?= \app\components\MenuWidget::widget(['tpl' => 'select', 'model' => $model])?>
        </select>
    </div>



    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>