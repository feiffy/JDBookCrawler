<?php
require_once '../vendor/autoload.php';

use GuzzleHttp\Client;

$baseURL = 'https://book.jd.com';

$httpClient = new Client();

// $itemURL = 'https://item.jd.com/11768572.html';
// $itemURL = 'https://item.jd.com/11768572.html';
$html = $httpClient->get($itemURL)->getBody()->getContents();
//$dom = str_get_html($html);
//$title = $dom->find('title', 0)->text();
//preg_match('/(《.+》)/i', $title, $matches);
//$bookTitle = $matches[1];
//file_put_contents("html/$bookTitle.html", $html);
file_put_contents("html/11768572.html", $html);
exit();