<?php $app = \App\Library\App::getInstance(); ?>

<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHPMemcachedAdmin<?= APP_VERSION !== '%%VERSION%%' ? ' '. APP_VERSION : ''?></title>
    <link rel="stylesheet" type="text/css" href="<?= $app->rootPath(); ?>/styles/style.css"/>
    <script>
        const basePath = '<?= $app->rootPath(); ?>';
    </script>
    <script src="<?= $app->rootPath(); ?>/scripts/highcharts/highcharts.js"></script>
    <script src="<?= $app->rootPath(); ?>/scripts/script.js"></script>
</head>
<body>
<div style="margin:0 auto; width:1000px; clear:both;">
    <div style="font-weight:bold;font-size:1.2em;"><a href="<?= $app->rootPath(); ?>/" style="color: #000;">PHPMemcachedAdmin<?= APP_VERSION !== '%%VERSION%%' ? ' <sup>'. APP_VERSION .'</sup>' : ''?></a></div>

    <div class="header corner full-size padding" style="margin-top:5px;">
        <a href="<?= $app->rootPath(); ?>/">See Stats</a> | <a href="<?= $app->rootPath(); ?>/stats">See Live Stats</a> | <a href="<?= $app->rootPath(); ?>/commands">Execute Commands</a> | <a href="<?= $app->rootPath(); ?>/data">Show data</a>
    </div>
