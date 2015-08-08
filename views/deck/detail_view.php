<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Deck */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deck-view">
	
		<h1 class="text-center"><?= Html::encode($this->title) ?></h1> 
	<section>
		<?= Html::a(Yii::t('app', 'Tune Pattern'), ['pattern/index', 'deck_id' => $model->id], ['class' => 'btn-block btn btn-default btn-primary'])?>
		<?php 
		if($model->pattern == NULL){
			echo Html::label(Yii::t('app', 'Add Card'),'' ,['class' => 'btn btn-default disabled']);
		}else{
			echo Html::a(Yii::t('app', 'Add Card'), ['card/create', 'deck_id' => $model->id], ['class' => 'btn btn-default btn-block btn-success']);
		}?>
		<a class="btn btn-default btn-warning btn-block">View Cards</a>
		<?php 
		if($model->cardsQty == NULL){
			echo Html::label(Yii::t('app', 'View Cards'),'' ,['class' => 'btn btn-default disabled']);
		}else{
			echo Html::a(Yii::t('app', 'View Cards'), ['card/index', 'deck_id' => $model->id], ['class' => 'btn btn-default btn-warning btn-block']);
		}?>		
	</section>
</div>

