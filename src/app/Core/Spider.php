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
use voku\helper\HtmlDomParser;

class Spider
{
    use HttpRequestTrait;

    /**
     * @desc 获取头条部分的3个链接数据
     */
    public function getBigNews($url='',$html='')
    {
        $url = 'http://www.badmintoncn.com/';
        $range = '.left-box-1 list-2';
        $rules = [
            'title' => ['a', 'text'],
        ];
        $rt = QueryList::get($url)->rules($rules)
            ->range($range)->query()->getData();
        var_dump($url,$rt->all());exit(PHP_EOL.'下午6:30'.PHP_EOL);




        try{
            $file = 'testContent1.inc';
            $dom = HtmlDomParser::str_get_html($html);
            $slideshow = $dom->find('a');//#slideshow li
            var_dump($slideshow);exit(PHP_EOL.'上午10:06'.PHP_EOL);
            foreach ($slideshow as $item) {
                var_dump($item->innerText);exit(PHP_EOL.'上午10:04'.PHP_EOL);
            }

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


    /**
     * @desc 发送消息到钉钉群
     * https://open-doc.dingtalk.com/docs/doc.htm?spm=a219a.7629140.0.0.karFPe&treeId=257&articleId=105735&docType=1#s5
     */
    public function sendToDingtalk()
    {
        $body = <<<MSG1
{
     "msgtype": "text",
     "text": {
         "content": "通过这个功能，可以给钉钉群发送消息！"
     },
     "at": {
         "atMobiles": [
             "1825718XXXX"
         ], 
         "isAtAll": false
     }
 }
MSG1;

        try{
            $fullApiUrl = 'https://oapi.dingtalk.com/robot/send?access_token=71a878604f93872427524fd3341553b35a291e7573a814cd4542e27274846391';
            $response = $this->httpRequest([
                'url'    => $fullApiUrl,
                'method' => 'POST',
                'body'   => $body,
                'header' => [
                    'Content-Type'=>'application/json',
                ],
            ]);
        }catch (\Exception $e) {
            $result = ['status'=>$e->getCode(), 'message'=>$e->getMessage(),];
            return $result;
        }
        var_dump($response);exit(PHP_EOL.'上午9:35'.PHP_EOL);

        return $response;
    }


    /**
     * @desc
     */
    public function test1()
    {
        $gUrl = 'http://www.badmintoncn.com/';
        for($i=188;$i<1800;$i++){
            $tmpp = ($i-1)*100;
            $str = "$tmpp,100";
//            $res = $db -> query([""],"",$str,"");
            $res = [
                'id'=>1,
                'url'=>''
            ];
            for($i=0;$i<100;$i++){
                $data = [];
                $tmp = QueryList::get($gUrl)->encoding('UTF-8','GB2312');
                $data['location'] = $tmp->find("#Label18")->text();
                $data['num'] = $tmp ->find("#Label16")->text();
                $data['date'] = $tmp ->find("#Label24")->text();
                $data['price'] = $tmp ->find("#Label23")->text();
                $data['company_b'] = $tmp ->find("#Label19")->text();
                $data['company_a'] = $tmp ->find("#Label21")->text();
                $data['type'] = $tmp ->find("#Label17")->text();
                $data['area'] = $tmp ->find("#Label22")->text();
                $tmp = null;
                $data = null;
            }
            $size = memory_get_usage();
            echo $this->convert($size).PHP_EOL;
            sleep(1);
            $tmpp = null;
            $str = null;
            $res = null;
            echo 'page: '.$i."\r\n";
        }
    }

    public function convert($size)
    {
        $unit=array('b','kb','mb','gb','tb','pb');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }
}
