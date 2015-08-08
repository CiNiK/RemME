<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CardField */
?>
<div class="card-field-view">
	<?= '<p style="'.$model->pattern->style.'" class="field"'.$id.'>'.$model->content.'</p>';?>
</div>
