<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\models\Deck */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deck-view">
	
		<h1 class="text-center"><?= Html::encode($this->title) ?></h1> 
	<section>
		<?= Html::a(Yii::t('app', '{tune} Tune Pattern',['tune' => FA::icon('wrench')]), ['pattern/index', 'deck_id' => $model->id], ['class' => 'btn-block btn btn-primary btn-lg'])?>
		
		<?php 	if($model->pattern == NULL){
					echo Html::label(Yii::t('app', 'Add Card'),'' ,['class' => 'btn btn-lg btn-block btn-success disabled']);
				}else{
					echo Html::a(Yii::t('app', '{plus} Add Card',['plus' => FA::icon('plus')]), ['card/create', 'deck_id' => $model->id], ['class' => 'btn btn-lg btn-block btn-success']);
				}?>

		<?php 	if($model->cardsQty == NULL){
					echo Html::label(Yii::t('app', 'View Cards'),'' ,['class' => 'btn btn-lg btn-warning btn-block disabled']);
				}else{
					echo Html::a(Yii::t('app', '{eye} View Cards',['eye' => FA::icon('eye')]), ['card/index', 'deck_id' => $model->id], ['class' => 'btn btn-lg btn-warning btn-block']);
				}?>		
	</section>
</div>

