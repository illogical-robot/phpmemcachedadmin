<?php
use App\Library\App;
        
$app = App::getInstance();
$base_url = $app->get('base_url') ?? '';

echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>PHPMemcachedAdmin <?php echo CURRENT_VERSION; ?></title>
    <script>
        <?php 
            echo 'var _base_url = "' . $base_url . '";';
        ?>
    </script>
    <link rel="stylesheet" type="text/css" href="<?= $base_url ?>/src/public/styles/style.css?<?php echo CURRENT_VERSION; ?>"/>
    <script type="text/javascript" src="<?= $base_url ?>/src/public/scripts/highcharts/highcharts.js?<?php echo CURRENT_VERSION; ?>"></script>
    <script type="text/javascript" src="<?= $base_url ?>/src/public/scripts/script.js?<?php echo CURRENT_VERSION; ?>"></script>
</head>
<body>
<div style="margin:0pt auto; width:1000px; clear:both;">
    <div style="font-weight:bold;font-size:1.2em;"><a href="<?= $base_url ?>/" style="color: #000;">PHPMemcachedAdmin</a> <sup><?php echo CURRENT_VERSION; ?></sup></div>

    <div class="header corner full-size padding" style="margin-top:5px;">
        <a href="<?= $base_url ?>/">See Stats</a> | <a href="<?= $base_url ?>/stats">See Live Stats</a> | <a href="<?= $base_url ?>/commands">Execute Commands</a> | <a href="<?= $base_url ?>/data">Show data</a>
    </div>

    <?php if (!App::getInstance()->isTempDirExists()) { ?>
        <?php exit('<div class="header corner full-size padding" style="margin-top:10px;">Error: Temporary directory <em>"'. App::getInstance()->tempDirPath() .'"</em> does not exist.</div>'); ?>
    <?php } elseif (!App::getInstance()->isTempDirWritable()) { ?>
        <?php exit('<div class="header corner full-size padding" style="margin-top:10px;">Error: Temporary directory <em>"'. App::getInstance()->tempDirPath() .'"</em> is not writable.</div>'); ?>
    <?php } ?>

    <?php if (!App::getInstance()->exists()) { ?>
        <?php exit('<div class="header corner full-size padding" style="margin-top:10px;">Error: Configuration file <em>"'. App::getInstance()->configFilePath() .'"</em> is missing.</div>'); ?>
    <?php } ?>

<!--[if IE]>
    <div class="header corner full-size padding" style="text-align:center;margin-top:10px;">
    Support browsers that contribute to open source, try <a href="https://www.firefox.com" target="_blank">Firefox</a> or <a href="https://www.google.com/chrome" target="_blank">Google Chrome</a>.
    </div>
<![endif]-->
