<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FA;
use app\assets\JsDiffAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Card */
$this->registerJsFile(Yii::getAlias('@web/js/textdiff.js'),['depends' => JsDiffAsset::className()]);
$this->title = Yii::t('app','Repeating...');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-view">
    <p>
        <?= Html::a(Yii::t('app', '{arrow} Next',['arrow' => FA::icon('forward') ]), ['next', 'deck_id' => $model->deck_id], ['class' => 'btn btn-primary']) ?>
    </p>
		<p>Front</p>
		<?php 	foreach($model->frontFields as $field)
				{
					echo $this->render('../cardField/view',['model' => $field, 'id' => null]);
				} ?>
	<div id = "check">
		<input id="answer">
		<button id='btn' class="btn" onclick="$('#check').hide();$('#back').show();">Show</button>
	</div>
	<div id='back' style="display:none">		
		<p>Back</p>
		<?php 	foreach($model->backFields as $field)
				{
					$id = ($model->keyField->field_id == $field->id) ? ' id="key"' : '';
					echo $this->render('../cardField/view',['model' => $field, 'id' => $id]);
				} ?>
	</div>
</div>
