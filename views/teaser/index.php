<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\modules\oblivki\components;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
		
$this->title = 'Teasers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teaser-index">

    <h1><?= Html::encode($this->title) ?></h1>
	
    <p>
        <?= Html::a('Создать тизеры', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<p>
        <?= Html::a('Тексты', ['texts'], ['class' => 'btn btn-success']) ?>
    </p>
	<p>
        <?= Html::a('Картинки', ['images'], ['class' => 'btn btn-success']) ?>
    </p>
	<p>
        <?= Html::a('Настройки', ['settings'], ['class' => 'btn btn-success']) ?>
    </p>

	<? //echo '<pre>'; print_r($dataProvider) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'text',
			[
				'label' => 'Картинка',
				'format' => 'raw',
				'value' => function($data){
					return Html::img($data['image'],[
						'style' => 'width:100px;'
					]);
				},
			],
			[
				'label' => 'Компания',
				'value' => function($data){
					return components\Teaser::getNameCompanieById($data['campaignId']);
				},
			],
			[
				'label' => 'Статус',
				'format' => 'html',
				'value' => function($data){
					switch($data['status']){
						case 'active':
							return '<p class="status label label-success">Идут показы</p>';
						case 'pause':
							return '<p class="status label label-default">Пауза</p>';
						case 'stop':
							return '<p class="status label label-default">Остановлен</p>';
						case 'moderation':
							return '<p class="status label label-warning">Модерации</p>';
						case 'rejected':
							return '<p class="status label label-danger">Отклонён</p>';
					}
				},
			],
			[
				'label' => 'Показы',
				'value' => function($data){
					return $data['totalViews'];
				},
			],
			[
				'label' => 'Клики',
				'value' => function($data){
					return $data['totalClicks'];
				},
			],
			[
				'label' => 'CTR',
				'value' => function($data){
					return $data['totalClicks'] != 0 ? round($data['totalClicks']/$data['totalViews']*100, 2) : null;
					//return ;
				},
			],
			[
				'label' => 'price_pc',
				'value' => function($data){
					return $data['price']['pcCommonPrice'];
				},
			],
			[
				'label' => 'price_mob',
				'value' => function($data){
					return $data['price']['mobileCommonPrice'];
				},
			],
			[
				'label' => 'price_tab',
				'value' => function($data){
					return $data['price']['tabletCommonPrice'];
				},
			],
			
            //'position',
            
            [
				'class' => 'yii\grid\ActionColumn',
				'header'=>'Действия', 
				'headerOptions' => ['width' => '80'],
				'template' => '{delete} {start} {stop}',
				'buttons' => [
					'start' => function ($url, $data) {
						return Html::a('<span class="glyphicon glyphicon-play"></span>', 
							Yii::$app->urlManager->createUrl(['teaser/start', 'id' => $data['id']])
						);
					},
					'stop' => function ($url, $data) {
						return Html::a('<span class="glyphicon glyphicon-stop"></span>', 
							Yii::$app->urlManager->createUrl(['teaser/stop', 'id' => $data['id']])
						);
					},
				],
			],
        ],
		'tableOptions' => ['class' => 'table table-striped table-bordered text-center'],
		'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
    ]); ?>
</div>
