<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CardField */
/* @var $form yii\widgets\ActiveForm */
?>

    <?= $form->field($model, '[' . $index . ']pattern_id')->hiddenInput()->label(false) ?>
	<?= $form->field($model, '[' . $index . ']side')->hiddenInput()->label(false) ?>

    <?= $form->field($model, '[' . $index . ']content')->textarea(['rows' => 2])->label($model->pattern->name) ?>

