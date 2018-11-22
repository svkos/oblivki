<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Teaser */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Teasers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teaser-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($modelFile, 'files[]')->fileInput(['multiple' => true])->label(''); ?>

    <div class="form-group">
        <?= Html::submitButton('Загрузить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

	<br>
	<h2>Загруженные фото</h2>
	
	<? foreach($modelImages as $model){?>
		<?php echo Html::img('@web/'.$model->path, ['class' => 'pull-left img-responsive', 'style' => 'width: 100px;']); ?>
	<? } ?>
</div>