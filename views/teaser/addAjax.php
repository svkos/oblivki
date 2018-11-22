<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Teaser */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Teasers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teaser-create">
	<h2>Добавить</h2>
	<form id="form">
		<?= Html::textInput('text','',['id'=>'text', 'class'=>'form-control']);?>
	</form>
	
	<br>
	<br>
	
	<h2>Добавленные</h2>
	<? foreach ($model as $m){ ?>
	    <div class="alert alert-main"> <? echo $m->text;?> </div><br>
	<? } ?>
</div>
<script>
$('#form').submit(function(event){
		event.preventDefault();
		$.ajax({
			url: '<?= Url::to(['teaser/add']);?>',
			method: 'POST',
			data: {text:$('#text').val(),type:'<?=$type?>'},
			success: function(data){
				location.reload();
			}
		})
	});
</script>