<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>
<div class="teaser-form">

    <?php $form = ActiveForm::begin(); ?>
		
    <?= $form->field($model, 'views')->textInput() ?>

    <?= $form->field($model, 'clicks')->textInput() ?>
	
	<?= $form->field($model, 'minutes')->textInput() ?>
	
	<?= $form->field($model, 'ctr')->textInput() ?>

	<?= $form->field($model, 'idcompanie')->hiddenInput(['id'=>'idcompanie'])->label(false) ?>
	
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
