<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pattern */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pattern',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->deck->name, 'url' => ['deck/view','id'=>$model->deck_id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patterns'), 'url' => ['index','deck_id'=>$model->deck_id]];
$this->params['breadcrumbs'][] = ['label' => Html::decode($model->name)];
?>
<div class="pattern-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
