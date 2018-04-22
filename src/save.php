<?php
error_reporting(E_ALL || ~E_NOTICE);
use Doctrine\ORM\EntityManager;
use Feiffy\PHPCrawler\Entity\Book;
use GuzzleHttp\Client;

require_once "bootstrap.php";

/**
 *书籍 [12223001, 12353958] 12353958 此区间的书籍已经抓取完毕
 */
for ($index = 12223001, $count = 1; $index <= 12226000; $index++) {
    $itemURL    = 'https://item.jd.com/' . $index . '.html';
    $isbnCached = [];
    $httpClient = new Client();

    $title        = '';
    $sub_title    = '';
    $author       = '';
    $publisher    = '';
    $isbn         = '';
    $packet_type  = '';
    $size         = '';
    $publish_date = '';
    $paper_type   = '';
    $pages        = 0;
    $wordage      = 0;
    try {
        $html = $httpClient->get($itemURL)->getBody()->getContents();
        $dom  = str_get_html($html);
        if ($dom == null)
            continue;

        $title = $dom->find('title', 0);
        if ($title == null)
            continue;

        $title = $title->plaintext;
        if ($title == null) continue;

        preg_match('/(《.+》)/i', $title, $matches);

        if ($matches[1] == null) continue;
        $title = $matches[1];

        $author = $dom->find('.p-author', 0);
        if ($author == null) continue;

        $author = $author->find('a', 0);
        if ($author == null) continue;

        $author = $author->plaintext;
        if ($author == null) continue;

        $liList = $dom->find('#parameter2', 0);
        if ($liList == null) continue;

        $liList = $liList->find('li');
        if ($liList == null) continue;

        foreach ($liList as $li) {
            $text = $li->plaintext;
            if (mb_strpos($text, '出版社') !== FALSE) {
                $publisher = $li->title;
            } elseif (mb_strpos($text, 'ISBN') !== FALSE) {
                $isbn = $li->title;
            } elseif (mb_strpos($text, '包装') !== FALSE) {
                $packet_type = $li->title;
            } elseif (mb_strpos($text, '开本') !== FALSE) {
                $size = $li->title;
            } elseif (mb_strpos($text, '出版时间') !== FALSE) {
                $publish_date = $li->title;
            } elseif (mb_strpos($text, '用纸') !== FALSE) {
                $paper_type = $li->title;
            } elseif (mb_strpos($text, '页数') !== FALSE) {
                $pages = $li->title;
                $pages = intval($pages);
            } elseif (mb_strpos($text, '字数') !== FALSE) {
                $wordage = $li->title;
                $wordage = intval($wordage);
            }
        }

        echo "count: $count, index: $index ";

        if($isbn == null) {
            echo "Exception: isbn is null!\n";
            continue;
        }

        if($isbnCached[$isbn] != null) {
            echo "Exception: isbn is exist!\n";
            continue;
        }

        $isbnCached[$isbn] = $isbn;

        $book = new Book();
        $book->setTitle($title);
        $book->setSubTitle($sub_title);
        $book->setAuthor($author);
        $book->setPublisher($publisher);
        $book->setPublishDate($publish_date);
        $book->setIsbn($isbn);
        $book->setSize($size);
        $book->setPages($pages);
        $book->setWordage($wordage);
        $book->setPaperType($paper_type);
        $book->setPacketType($packet_type);
        $book->setCreatedTime(new DateTime());
        $book->setUpdatedTime(new DateTime());
        $entityManager->persist($book);
        $count++;
        // $entityManager->flush();

        echo "Created Book with Title " . $book->getTitle() . "\n";
        if($count%20 == 0) {
            $entityManager->flush();
            echo "\n\n\n-----------saved 20 objects-----------\n\n\n";
        }
    } catch (Exception $e) {
        echo $e->getMessage() . "\n";
        unset($entityManager);
        $conn2          = array(
            'dbname'   => 'jd_book',
            'user'     => 'root',
            'password' => 'root',
            'host'     => 'localhost',
            'driver'   => 'pdo_mysql',
        );
        $entityManager = EntityManager::create($conn2, $config);
        echo "The EntityManager is restarted\n";
        continue;
    }
}
$entityManager->flush();
echo "saved end ". ($count%20) ." objects\n";