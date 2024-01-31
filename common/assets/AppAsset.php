<?php
namespace common\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css', // Bootstrap Icons
        // ... You can add more CSS files here
    ];
    public $js = [
        // ... And JavaScript files here
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset', // or 'yii\bootstrap4\BootstrapAsset' for Bootstrap 4
    ];
}
