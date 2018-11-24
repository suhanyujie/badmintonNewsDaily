# badmintonNewsDaily
* 羽毛球每日快讯

## 依赖
### DOM解析
* composer require voku/simple_html_dom
* composer require voku/portable-utf8 # if you need e.g. UTF-8 fixed output

 

### 短网址服务
* 使用的是新浪的短网址服务：http://dwz.wailian.work/

## 其他
### composer慢问题 
* composer install时，如果很慢，可以先执行一下`composer config repo.packagist composer https://packagist.phpcomposer.com`，将包镜像源改为国内的

### 编码问题
* nodejs中编码问题 参考 http://www.9958.pw/post/nodejs_gbk

