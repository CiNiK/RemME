<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Card */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-form">

	
    <?php 
		$form = ActiveForm::begin(); 
		$index = 0;
	?>
	
	<p>Front</p>
	
	<?php 
		echo $form->field($model,'deck_id')->hiddenInput()->label(false);
		foreach($model->frontFields as $field){
			echo $this->render('../cardField/_form', [
					'model'=>$field,
					'form'=>$form, 
					'index'=>++$index
			]);
	}?>
	
	<p>Back</p>
	
	<?php 
		foreach($model->backFields as $field){
			echo $this->render('../cardField/_form', [
					'model'=>$field,
					'form'=>$form, 
					'index'=>++$index
			]);

	}?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
