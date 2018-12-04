<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
	
	 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id_api',
			[
				'attribute'=>'name',
				'label'=>'Имя',
				'content'=>function($data){
					return Html::a($data['name'], ['offer/companie/teaser?id='.$data['id_companie']]);
				}
			],
			
			[
				'class' => 'yii\grid\ActionColumn',
				'header'=>'Действия', 
				'headerOptions' => ['width' => '80'],
				'template' => '{delete}',
			],
        ],
    ]); ?>
   
</div>