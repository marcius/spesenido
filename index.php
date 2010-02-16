<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii-1.1.0.r1700/framework/yii.php';
//$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);



$prodConfig = require(dirname(__FILE__).'/protected/config/main.php');
$localConfigFile = dirname(__FILE__).'/protected/local/config/main.php';
if (file_exists($localConfigFile))
  $config = CMap::mergeArray($prodConfig, include($localConfigFile));
else
  $config = $prodConfig;
Yii::createWebApplication($config)->run();
