<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Offer;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Teaser */

$this->title = 'Create Teaser';
$this->params['breadcrumbs'][] = ['label' => 'Teasers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teaser-create">

    <?php $form = ActiveForm::begin(); ?>
		
	<label class="control-label" for="teaser-idcompanie">Оффер</label>	
	<?= Html::DropDownList('Teaser[id_offer]', 'id_offer',
                            ArrayHelper::map(Offer::getAll(), 'id_offer', 'name'),
                            [
								'prompt' => 'Не установлено',
								'class'=>'form-control',
								'onchange' => '
									$.post("'.Url::toRoute('ajax/get-companie-by-offer?id=').'"+$(this).val(),
										function(data){
											$("select#companie").html(data);
										}
									)',
                            ]
                        ) ?>

	<?= $form->field($model, 'idcompanie')->dropDownList($companies,[
							'prompt' => 'Выберите компанию',
							'id'=>'companie'
						]); ?>
	
	<?= $form->field($model, 'count')->textInput(['maxlength' => true]) ?>
	
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
