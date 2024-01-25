<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class PublicAreaAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/tco_public.css', // Your public area specific CSS file
    ];
    public $js = [
        'js/pageArticleRefs.js',
    ];
}
