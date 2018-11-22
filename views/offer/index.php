<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php foreach($model as $item): ?>
		<?= Html::a($item->name, [ Url::to(['companie']), 'id' => $item->id_offer]) ?>
		<br>
	<?php endforeach; ?>
   
</div>