#!/usr/local/bin/node

let http = require("http"),
    cheerio = require('cheerio'),
    iconv = require('iconv-lite'),
    BufferHelper = require('bufferhelper');


var dataArr = new Array();
main();
console.log(dataArr);
function main() {
    var post_options2 = {
        host: 'www.badmintoncn.com',
        port: '80',
        path: '/',
        method: 'GET',
        query: '',
        headers:{
            'Content-Type': 'text/html',
        }
    };
    var bufferHelper = new BufferHelper();
    var post_req = http.request(post_options2, function(res) {
        var chunks = [], size = 0;
        res.on('data', function (chunk) {
            size += chunk.length;
            // chunks.push(chunk);
            bufferHelper.concat(chunk);
        });
        res.on('end', function () {
            //resData = chunks.join('');
            var htmlStr = iconv.decode(bufferHelper.toBuffer(),'GBK')
            var $ = cheerio.load(htmlStr);
            var liArr = $('#slideshow ul li');
            var tmpLink='';
            // 这里 index为索引
            liArr.map((index,item) => {
                // 获取期数
                //let period = tmpTotalTr.eq(index).find('td').eq(0).find('.p').text();
                //获得标题
                tmpLink = $(item).find('a').attr('href')
                if (tmpLink) {
                    dataArr.push({
                        title:$(item).find('.caption').text(),
                        link:tmpLink,
                    });
                }
            });// end of map

            console.log(dataArr);
        });
        res.on('error',(e)=>{
            console.log(e);
        });
    });
    post_req.write('');
    post_req.end();
}