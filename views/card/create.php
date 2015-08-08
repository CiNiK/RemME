<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Card */

$this->title = Yii::t('app', 'Create Card');
$this->params['breadcrumbs'][] = ['label' => $model->deck->name, 'url' => ['deck/view','id' => $model->deck->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cards'), 'url' => ['index','deck_id'=>$model->deck->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
		'model'	=> $model,
    ]) ?>

</div>
