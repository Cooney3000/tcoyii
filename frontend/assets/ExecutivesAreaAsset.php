<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class ExecutivesAreaAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/tco_executives.css', // Your members area specific CSS file
    ];
}