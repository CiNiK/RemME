<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $model app\models\Pattern 
"*/
?>

<div class="field clearfix" style="height:auto;">
	<div style="float:left;" class="position">
		<?= ($model->key) ? '<span class="key">'.FA::icon('star')->size(FA::SIZE_2X).'</span>' : '';?>
		<?= Html::a(Yii::t('app', '{up}',['up' => FA::icon('arrow-up')]), ['up', 'id' => $model->id], 
											['class' => ($model->isFirst === true) ? 'up disabled' : 'up']) ?>
		<?= Html::a(Yii::t('app', '{down}',['down' => FA::icon('arrow-down')]), ['down', 'id' => $model->id], 
											['class' => ($model->isLast === true) ? 'down disabled' : 'down']) ?>
	</div>
	<div style="float:left; min-width:40%; width:100%" class="content">
		 <?= '<p style="'.$model->style.'" class="field">'.$model->name.'</p>';?>
	</div>
	<div  style="float:left;" class="manage">
		<?= Html::a(Yii::t('app', '{update}',['update' => FA::icon('edit')->size(FA::SIZE_2X)]), ['update', 'id' => $model->id], ['class' => 'edit']) ?>
        <?= Html::a(Yii::t('app', '{remove}',['remove' => FA::icon('remove')->size(FA::SIZE_2X)]), ['delete', 'id' => $model->id], [
            'class' => 'delete',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
	</div>
</div>

