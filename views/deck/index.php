<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Decks');
?>
<div class="deck-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Deck'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	<?= ListView::widget([
			'dataProvider' => $dataProvider,
			'itemView' => 'item_view',
			'layout' => "{items}\n",
		]); ?>

</div>
