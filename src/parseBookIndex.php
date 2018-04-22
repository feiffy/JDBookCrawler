<?php
/**
 * 获取 book.jd.com 首页中的所有书籍页链接
 */


use GuzzleHttp\Client;

require_once "bootstrap.php";

$indexURL   = 'https://book.jd.com';
$httpClient = new Client();
$html       = $httpClient->get($indexURL)->getBody()->getContents();
$dom        = str_get_html($html);
$aList      = $dom->find('a');
if (!$aList) exit('no a list!');
$linkList = [];
foreach ($aList as $a) {
    $href = $a->href;
    if (mb_strpos($href, 'item.jd.com') !== FALSE) {
        $linkList[] = $href;
    }
}

print_r($linkList);