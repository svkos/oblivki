<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Teaser */

$this->title = 'Update Teaser: {api_idteaser}';
$this->params['breadcrumbs'][] = ['label' => 'Teasers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->idteaser]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teaser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'companies' => $companies		
    ]) ?>

</div>
