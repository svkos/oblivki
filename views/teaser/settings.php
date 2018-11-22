<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = ['label' => 'Teasers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teaser-form">

	<h1>Настройки компаний</h1>
    
	<?= Html::dropDownList('idcompanie', 'null', $companies, [
					'prompt' => 'Выберите компанию',
					'class' => 'form-control',
					'onchange'=>'$.post("'.Url::toRoute(['teaser/getsettings']).'&idcompanie="+$(this).val(), function(data){
						$("#settings").html(data);
						});
				']); ?>
	<br>
	<div id='settings'></div>	
	
</div>
