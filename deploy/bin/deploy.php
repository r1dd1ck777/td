#!/usr/bin/env php
<?php
const DIR = '/var/www/td/td';

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require __DIR__.'/../vendor/autoload.php';
deployer();

task('prod', function () {
    connect('146.185.148.79', 'deployer', 'ahsgdf_');
    runIn('git pull origin master');
    runIn('bin/cc && bin/asset');
});

start();

function runIn($cmd, $dir = DIR)
{
    run("cd ".$dir." && source ~/.bash_profile && {$cmd}");
}

