<?php

require_once "../core/HtmlEntitle.php";
require_once "../core/Func.php";
require_once "../core/File.php";

$link = "http://www.cfsshfly.com/show01-29/t9i-65667.html";



getContent($link);

function getContent($link)
{
    $info = parse_url($link);
    if(empty($info['host'])){
        return false;
    }
    $info['scheme'] = $info['scheme'] ?? 'http';
    $domain = $info['scheme'] . '://' . $info['host'];
    $content = send($link);
    $links = parseContent($content, $domain);
    if(!empty($links)){
        foreach ($links as $link){
            getContent($link);
        }
    }else{
        return false;
    }
}

function send($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,  CURLOPT_HEADER,true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_USERAGENT, "Sogou web spider/4.0(+http://www.sogou.com/docs/help/webmasters.htm#07)");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $r = curl_exec($ch);
    curl_close($ch);
    return $r;
}

function parseContent($content, $domain='')
{
    $links = [];
    $content = HtmlEntitle::decode(encoding($content));
    preg_match("/\<title>(.*)\<\/title>/iU", $content, $matches);
    if(!empty($matches[1])){
        $path = '../data/words/';
        @file_put_contents($path . 'title.txt', $matches[1] . PHP_EOL, FILE_APPEND);
        print_r('标题：' . $matches[1] . ' 下载完成！' . PHP_EOL);
    }

    preg_match_all("/\<a(.*)? href=\"(.*)\" title=\"(.*)\">(.*)\<\/a>/iU", $content, $matches);
    if(!empty($matches[2])){
        $links = $matches[2];
    }
    if(!empty($matches[3])){
        $path = '../data/words/';
        foreach ($matches[3] as $word){
            @file_put_contents($path . 'word.txt', $word . PHP_EOL, FILE_APPEND);
            print_r('小词：' . $word . ' 下载完成！' . PHP_EOL);
        }
    }
    preg_match_all("/\<p>(.*)\<\/p>/iU", $content, $matches);
    if(!empty($matches[1])){
        $path = '../data/words/';
        foreach ($matches[1] as $section){
            $section = Func::specialFilter($section);
            @file_put_contents($path . 'section.txt', $section . PHP_EOL, FILE_APPEND);
            print_r('段落：' . $section . ' 下载完成！' . PHP_EOL);
        }
    }
    $domain = str_replace(['/', '.'], ['\\/', '\\.'], $domain);
    preg_match_all("/src=\"(" . $domain . "\/images\/\d+\.jpg)\"/iU", $content, $matches);
    if(!empty($matches[1])){
        $path = '../data/images/';
        foreach ($matches[1] as $image){
            $info = pathinfo($image);
            @file_put_contents($path.$info['filename'].'.jpg', file_get_contents($image));
            print_r('图片：' . $image . ' 下载完成！' . PHP_EOL);
        }
    }
    return $links;
}

function encoding($str){
    $encode = mb_detect_encoding($str, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
    if($encode == "UTF-8") return $str;
    return  @mb_convert_encoding($str, 'UTF-8', $encode);
}