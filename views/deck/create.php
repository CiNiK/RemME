<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Deck */

$this->title = Yii::t('app', 'Create Deck');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deck-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
