<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Offer;

/* @var $this yii\web\View */
/* @var $model app\models\Teaser */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Teasers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teaser-create">	
	<label class="control-label" for="teaser-idcompanie">Оффер</label>	
	<?= Html::DropDownList('name', 'id_offer',
                            ArrayHelper::map(Offer::getAll(), 'id_offer', 'name'),
                            [
								'prompt' => 'Не установлено',
								'class'=>'form-control',
								'onchange' => '
									$.post("'.Url::toRoute('ajax/'.$action.'?id=').'"+$(this).val(),
										function(data){
											$("#ajax").html(data);
										}
									)',
                            ]
                        ) ?>
	<br>
	<div id="ajax"></div>
</div>