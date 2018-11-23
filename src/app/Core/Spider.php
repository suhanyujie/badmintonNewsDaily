<?php
/**
 * Created by PhpStorm.
 * User: suhanyu
 * Date: 18/11/23
 * Time: 下午5:38
 */

namespace App\Core;

use App\Traits\HttpRequest as HttpRequestTrait;
use QL\QueryList;

class Spider
{
    use HttpRequestTrait;


    /**
     * @desc 获取头条部分的3个链接数据
     */
    public function getBigNews($url='')
    {
        try{

//            $url = 'https://it.ithome.com/ityejie/';
//            // 元数据采集规则
//            $rules = [
//                'title' => ['h2>a', 'text'],
//                'link'  => ['h2>a', 'href'],
//                'img'   => ['.list_thumbnail>img', 'src'],
//                'desc'  => ['.memo', 'text']
//            ];
//            // 切片选择器
//            $range = '.ulcl';
//            $rt    = QueryList::get($url)->rules($rules)
//                ->range($range)->query()->getData();
//            print_r($rt->all());


            //$ql = QueryList::get($url);
//            $range = '.ulcl li';
//            $rules = [
//                'title' => ['h2>a', 'text'],
//                'link' => ['h2>a','href'],
//            ];
//            $rt = QueryList::get($url)->rules($rules)
//                ->range($range)->query()->getData();

            $range = '#slideshow ul li';
            $rules = [
                'title' => ['.caption', 'text'],
                'link' => ['a', 'href'],
            ];
            $res = QueryList::get($url)->encoding('UTF-8','GB2312')
                ->range($range)->query()->getData();
            var_dump($res);exit(PHP_EOL.'下午6:01'.PHP_EOL);

        }catch (\Exception $e) {
            $result = ['status'=>$e->getCode(),'msg'=>$e->getMessage()];
            var_dump($result);exit(PHP_EOL.'下午6:07'.PHP_EOL);
        }
        exit('1232312');

        return [
            'status'=>1,
            'data'=>[

            ],
        ];
    }

    /**
     * @desc 获取首页内容
     * @return array
     */
    public function getContent($url = '')
    {
        try{
            $fullApiUrl = $url;
            $response = $this->httpRequest([
                'url'    => $fullApiUrl,
                'method' => 'GET',
                'body'   => '',
                'header' => [
//                    'Content-Type'=>'application/x-www-form-urlencoded',
                ],
            ]);
        }catch (\Exception $e) {
            $result = ['status'=>$e->getCode(), 'message'=>$e->getMessage(),];
            return $result;
        }

        return $response;
    }
}
