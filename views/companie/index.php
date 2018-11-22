<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Компании';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Редактировать компании', ['offer/companie/edit'], [ 'class'=> 'btn btn-success']) ?>
	</p>	
	<?php foreach($model as $item): ?>
		<?= Html::a($item->name, ['teaser', 'id' => $item->id_companie]) ?>
		<br>
	<?php endforeach; ?>
   
</div>