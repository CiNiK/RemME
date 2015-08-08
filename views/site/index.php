<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'RemMe';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead"><?=Yii::t('app', 'To create a deck you have to log in');?></p>
        <p><a class="btn btn-lg btn-success" href="<?= Url::toRoute('user/login')?>"><?=Yii::t('app','Login');?></a>
		<a class="btn btn-lg btn-success" href="<?= Url::toRoute('user/register')?>"><?=Yii::t('app','Register');?></a></p>
    </div>

    <div class="body-content">

    </div>
</div>
