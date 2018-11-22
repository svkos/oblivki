<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Teaser */

$this->title = 'Create Teaser';
$this->params['breadcrumbs'][] = ['label' => 'Teasers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teaser-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'count')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'idcompanie')->dropDownList($companies,[
							'prompt' => 'Выберите компанию',
						]); ?>
	
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
