<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Teaser */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="teaser-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => '6']) ?>	
	
	<?= $form->field($model, 'idcompanie')->dropDownList($companies,[
					'prompt' => 'Выберите компанию',
					'onchange'=>'document.getElementById("name_companie").value = this.options[this.selectedIndex].text']); ?>
	
	<?= $form->field($model, 'name_companie')->hiddenInput(['id'=>'name_companie'])->label(false) ?>
	
    <?= $form->field($model, 'price_pc')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'price_mob')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'price_tab')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
