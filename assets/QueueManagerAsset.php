<?php
namespace ignatenkovnikita\queuemanager\assets;

/**
 * Copyright (C) $user$, Inc - All Rights Reserved
 *
 *  <other text>
 * @file        QueueManagerAsset.php
 * @author      ignatenkovnikita
 * @date        $date$
 */

/**
 * Created by PhpStorm.
 * User: ignatenkovnikita
 * Web Site: http://IgnatenkovNikita.ru
 */
class QueueManagerAsset extends \yii\web\AssetBundle
{
//    public $depends = [
//        'yii\web\JqueryAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'trntv\filekit\widget\BlueimpFileuploadAsset'
//    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . "/../";
//        $this->css = [
//            YII_DEBUG ? 'css/upload-kit.css' : 'css/upload-kit.min.css'
//        ];

        $this->js = [
            'js/queuemanager.js'
        ];
        parent::init();
    }

}