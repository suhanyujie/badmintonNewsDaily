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
$html = <<<H1
<div>
<a href="http://laravel.suhanyu.top">13123123</a>
</div> 
H1;

$html1 = <<<H2
<html>
<body>
<div class="container">
    <div class="menu-hot"></div>
    <div class="topmenu">
        <div><a href="//www.badmintoncn.com">首页</a><a href="javascript:window.external.AddFavorite('//www.badmintoncn.com','中羽在线 第一羽毛球互动门户-中国羽球在线')">添加收藏</a><a href="" onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('//www.badmintoncn.com');">设为首页</a><a href="//bbs.badmintoncn.com/thread-340183-1-1.html" target="_blank" style="color:#fff100;">中羽APP</a></div>
    </div>
    <div class="top">
        <div class="logo"><a href="./"><img src="cbo_news/style/img/logo.png" alt="中国羽球在线" /></a></div>
        <div class="so">
            <form name="formsearch" action="search.php">
                <input name="keyword" id="keyword" type="text" style="color:#999;" size="20" value="输入要找的内容..."  />
                <input type="submit" />
            </form>
        </div>
    </div>
</div>
</body>
</html>
H2;

$html3 = <<<H3

H3;
$html3 = file_get_contents('testContent1.inc');



//$res = $spider->getBigNews($newsUrl,$html3);
$res = $spider->test1();
//$res = $spider->sendToDingtalk();
var_dump($res);exit(PHP_EOL.'下午5:44'.PHP_EOL);
