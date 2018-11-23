<?php
/**
 * Created by PhpStorm.
 * User: suhanyu
 * Date: 18/11/23
 * Time: 下午5:31
 */

require __DIR__.'/../vendor/autoload.php';

use App\Core\Spider;

$spider = new Spider();

$newsUrl = 'http://www.badmintoncn.com/';
$res = $spider->getBigNews($newsUrl);
var_dump($res);exit(PHP_EOL.'下午5:44'.PHP_EOL);
