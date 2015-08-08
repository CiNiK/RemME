<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\models\Pattern */
?>
<div class="row">
	<div class="col-sm-9 col-md-9 col-lg-8 col-xs-9">
		 <h3><?= $model->name ?></h3>
	</div>
	<div class="col-sm-3 col-md-3 col-lg-4 col-xs-3 text-right">
		<?= Html::a(Yii::t('app', '{play} Start',['play' => FA::icon('play')]), ['card/next', 'deck_id' => $model->id,], ['class' => 'btn btn-warning btn-sm']) ?>
		<?= Html::a(Yii::t('app', '{eye} View',['eye' => FA::icon('eye')]), ['view', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(Yii::t('app', '{remove} Delete',['remove' => FA::icon('remove')]), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
	</div>
</div>

