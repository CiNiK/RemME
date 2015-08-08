<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JQueryAsset;
//use mihaildev\ckeditor\CKEditor;

$this->registerJsFile(Yii::getAlias('@web/markitup/jquery.markitup.js'),['depends' => JqueryAsset::className()]);
$this->registerJsFile(Yii::getAlias('@web/markitup/sets/css/set.js'),['depends' => JqueryAsset::className()]);
$this->registerJsFile(Yii::getAlias('@web/js/markitup.js'),['depends' => JqueryAsset::className()]);
$this->registerJsFile(Yii::getAlias('@web/jquery-ui/jquery-ui.min.js'),['depends' => JqueryAsset::className()]);
$this->registerJsFile(Yii::getAlias('@web/farbtastic/farbtastic.js'),['depends' => JqueryAsset::className()]);
$this->registerJsFile(Yii::getAlias('@web/js/jquery.fontselector.js'),['depends' => JqueryAsset::className()]);

$this->registerCssFile(Yii::getAlias('@web/markitup/skins/simple/style.css'));
$this->registerCssFile(Yii::getAlias('@web/markitup/sets/css/style.css'));
$this->registerCssFile(Yii::getAlias('@web/farbtastic/farbtastic.css'));
$this->registerCssFile(Yii::getAlias('@web/css/fontselector.css'));
$this->registerCssFile(Yii::getAlias('@web/css/plugins.css'));

/* @var $this yii\web\View */
/* @var $model app\models\Pattern */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pattern-form">

    <?php $form = ActiveForm::begin(['id'=>'pattern-form']); ?>
	
	<?= $form->field($model, 'name',['inputOptions'=>['id' => 'markItUp','style'=>$model->style]])->textInput();?>
	<?= Html::activeRadio($model, 'key', ['class' => 'agreement']) ?>
	<?= $form->field($model,'deck_id')->hiddenInput()->label(false) ?>
	
	<?= $form->field($model,'side')->hiddenInput()->label(false) ?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div id="colorPlugin">
	<div class="toolbar">
    	<a href="#" class="handle">Move</a> <a href="#" class="close">Close</a>    </div>
	<div class="module">
		<h3>Colors</h3>
		<div class="colors slide">
			<p><a href="http://acko.net/dev/farbtastic">Farbtastic plugin</a> by Steven Wittens</p>
            <div id="picker"></div>
			<p>
			<input type="text" id="color" name="color" value="#123456" />
			<a href="#">add to editor</a>			</p>
		</div>
	</div>
</div>
