<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pattern */

$this->title = Yii::t('app', 'Create Pattern');
$this->params['breadcrumbs'][] = ['label' => $model->deck->name, 'url' => ['deck/view','id'=>$model->deck_id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patterns'), 'url' => ['index','deck_id'=>$model->deck_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pattern-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
