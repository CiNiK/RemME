<?php
namespace app\assets;

use yii\web\AssetBundle;

class JsDiffAsset extends AssetBundle
{
    public $sourcePath = '@bower/jsdiff';
    public $baseUrl = '@web';
    public $css = [
        
    ];
    public $js = [
        'diff.js',
	];
	public $depends = [
        'yii\web\JQueryAsset',
    ];
}