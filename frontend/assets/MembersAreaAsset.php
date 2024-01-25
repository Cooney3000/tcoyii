<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class MembersAreaAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/tco_members.css', // Your members area specific CSS file
    ];
}