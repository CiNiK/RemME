<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cards');
$this->params['breadcrumbs'] = [ ['label' =>$deck->name,'url' => ['deck/view', 'id' => $deck->id],],$this->title];?>
<div class="card-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Card'), ['create','deck_id' => $deck->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
			'dataProvider' 	=> $dataProvider,
			'filterModel'	=> $searchModel,
			'layout' => "{sorter}\n{items}\n",
			'columns' => [
				'content',
				'created',
				['class' => 'yii\grid\ActionColumn'],
			]
    ]) ?>

</div>
