<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Card */
$this->registerCssFile('/web/css/card.css');
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
	<div class='side'>
	<p>Front</p>
	<?php 	foreach($model->frontFields as $field)
			{
				echo DetailView::widget([
					'model' => $field,
					'attributes' => [
						[
						'label' => $field->pattern->name,
						'value' => $field->content,
						],
					],
			]);
			} ?>
	</div>	
	<div class='side'>
	<p>Back</p>
	<?php 	foreach($model->backFields as $field)
			{
				echo DetailView::widget([
					'model' => $field,
					'attributes' => [
						[
						'label' => $field->pattern->name,
						'value' => $field->content,
						],
					],
			]);
			} ?>
	</div>
</div>
