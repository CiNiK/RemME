<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CardField */

$this->title = Yii::t('app', 'Create Card Field');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Card Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-field-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
