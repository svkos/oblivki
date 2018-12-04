<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
	<h2>Добавить</h2>						
	<form id="form">
		<?= Html::textInput('text','',['id'=>'text', 'class'=>'form-control']);?>
	</form>
	
	<br>
	<br>
	
	<h2>Добавленные</h2>
	<? foreach ($models as $model){ ?>
	    <div class="alert alert-main"> <? echo $model->text;?> </div><br>
	<? } ?>

<script>
$('#form').submit(function(event){
		event.preventDefault();
		$.ajax({
			url: '<?= Url::to(['ajax/add-text']);?>',
			method: 'POST',
			data: {text:$('#text').val(),id_offer:'<?=$id_offer?>'},
			success: function(data){
				location.reload();
			}
		})
	});
</script>