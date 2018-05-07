<?php

namespace app\assets;

use yii\web\AssetBundle;

class AuditColumnAssetsBundle extends AssetBundle
{
    public $sourcePath = '@app/assets/audit-column';
    public $css = [
        'styles.css'
    ];
    public $js = [
        'scripts.js'
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}