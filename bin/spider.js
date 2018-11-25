#!/usr/local/bin/node

let http = require("http"),
    cheerio = require('cheerio'),
    iconv = require('iconv-lite'),
    BufferHelper = require('bufferhelper');
const fs = require('fs'),
    path = require('path');

new Promise(function(resolve,reject){
    main(resolve)
}).then(function (value) {
    var fileName = createFile()
    var res = fs.writeFileSync(fileName, JSON.stringify(value))
    console.log(res);
});


function main(resolve) {
    var dataArr = new Array();
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
            bufferHelper.concat(chunk);
        });
        res.on('end', function () {
            //resData = chunks.join('');
            var htmlStr = iconv.decode(bufferHelper.toBuffer(),'GBK')
            var $ = cheerio.load(htmlStr);
            var liArr = $('#slideshow ul li');
            var tmpLink='',baseUrl='http://www.badmintoncn.com';
            // 这里 index为索引
            liArr.map((index,item) => {
                //获得标题
                tmpLink = $(item).find('a').attr('href')
                if (tmpLink) {
                    tmpLink = baseUrl + '/' +tmpLink
                    dataArr.push({
                        title:$(item).find('.caption').text(),
                        link:tmpLink,
                    });
                }
            });// end of map
            resolve(dataArr)
            return dataArr;
        });
        res.on('error',(e)=>{
            console.log(e);
        });
    });
    post_req.end();
}

function createFile(resolve) {
    var dateObj = new Date()
    var year = dateObj.getFullYear(),
        month = dateObj.getMonth()+1,
        day = dateObj.getDate();
    var filePath = "/../storage/data/"+year+'/'+month;
    filePath = __dirname+filePath
    var isExist = fs.existsSync(filePath)
    if (!isExist) {
        if (!mkdirsSync(filePath)) {
            return false;
        }
    }
    var fileName = `${filePath}/${year}-${month}-${day}.json`
    var res = fs.openSync(fileName,'w')
    fs.closeSync(res)

    return fileName;
}

// 递归创建目录 同步方法
function mkdirsSync(dirname) {
    if (fs.existsSync(dirname)) {
        return true;
    } else {
        if (mkdirsSync(path.dirname(dirname))) {
            fs.mkdirSync(dirname);
            return true;
        }
    }
}
