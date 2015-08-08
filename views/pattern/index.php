<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
use rmrevin\yii\fontawesome\FA;

$this->registerCssFile('/web/css/card.css');
$this->title = Yii::t('app', 'Pattern');
$this->params['breadcrumbs'] = [ ['label' =>$deck->name,'url' => ['deck/view', 'id' => $deck->id],],$this->title];
?>
<div class="pattern-index">

    <h2><?= Html::encode($this->title) ?></h2>
	
	<div class="row">
		
			<h3 class="text-muted text-center">Front</h3>
		<div class="side">
			<?= ListView::widget([
				'dataProvider' => $frontDataProvider,
				'itemView' => 'item_view',
			]); ?>
		</div>
			<div class=".container text-center">
				 <?= Html::a(Yii::t('app', '{plus} Add Front Field',['plus' => FA::icon('plus')]), ['pattern/create','deck_id' => $deck->id,'side' => 'front'], 
								['class' => 'btn btn-primary btn btn-info btn-lg']) ?>
			</div>
	</div>
		
	<div class="row">
			<h3 class="text-muted text-center">Back</h3>
			<div class="side col-lg-12">
				<?= ListView::widget([
					'dataProvider' => $backDataProvider,
					'itemView' => 'item_view',
				]); ?>
			</div>
			<div class=".container text-center">
				 <?= Html::a(Yii::t('app', '{plus} Add Back Field',['plus' => FA::icon('plus')]), ['pattern/create','deck_id' => $deck->id,'side' => 'back'], 
								['class' => 'btn btn-primary btn btn-warning btn-lg']) ?>
			</div>
	</div>

</div>
