<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use app\models\Offer;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */
/* @var $form yii\widgets\ActiveForm */
?>

<p>
	<?= Html::a('Загрузить все', ['offer/companie/load-from-api'], [ 'class'=> 'btn btn-success']) ?>
</p>
	
<div class="offer-form">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id_companie',
			'id_api',
            'name',
			
			[
				'attribute'=>'id_offer',
				'label'=>'Продукт',
				'format'=>'text', 
				'content'=>function($data){
					return Html::DropDownList('offer', $data['id_offer'],
                            ArrayHelper::map(Offer::getAll(), 'id_offer', 'name'),
                            [
								'prompt' => 'Не установлено',
								'class'=>'selectpicker float-left',
								'onchange'=>'
									$.post( "'.Url::to('ajax-set-offer?id_api='.$data['id_api'].'&id_offer=').'"+$(this).val(), function( data ) {
										$( "#status'.$data['id_companie'].'" ).html( data ).fadeIn().delay(400).fadeOut();
								})',
                            ]
                        ).'<div id="status'.$data['id_companie'].'" style="display:none"></div>';
				},
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
<script>
$( document ).ready(function() {
  $('select').selectpicker();
});
</script>