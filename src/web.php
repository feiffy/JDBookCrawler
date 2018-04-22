<?php
require_once "bootstrap.php";
$bookRepo     = $entityManager->getRepository('Feiffy\PHPCrawler\Entity\Book');
$page_id      = $_REQUEST['page_id'] ?: 1;
$page_limit   = $_REQUEST['page_limit'] ?: 100;
$offset       = ($page_id - 1) * $page_limit;
$search       = [];
$queryBuilder = $bookRepo->createQueryBuilder('b');
if ($_REQUEST['title']) {
    $queryBuilder->where('b.title LIKE :title')->setParameter('title', $_REQUEST['title'] . '%');
}
if ($_REQUEST['author']) {
    $queryBuilder->andWhere('b.author LIKE :author')->setParameter('author', $_REQUEST['author'] . '%');
}
if ($_REQUEST['publisher']) {
    $queryBuilder->andWhere('b.publisher LIKE :publisher')->setParameter('publisher', $_REQUEST['publisher'] . '%');
}
$books = $queryBuilder->setMaxResults($page_limit)->setFirstResult($offset)->getQuery()->getResult();

$count = $queryBuilder->select('count(1)')->getQuery()->getSingleScalarResult();
$pages = intval($count / $page_limit);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table td {
            padding: 2px 5px;
        }

        table th {
            padding: 2px 5px;
            background-color: darkgrey;
        }

        #page_id {
            display: inline-block;
            width: 30px;
            height: 15px;
            border: 1px solid #999999;
            background-color: #EEEEEE;
            text-align: center;
        }

        #page_id:hover {
            background-color: #FFFFFF;
            color: red;
        }
    </style>
</head>
<body>
<b>count: <?= $count ?></b>
<p>
    <?php
    for ($i = 1; $i <= $pages; $i++) {
        echo " <a id=\"page_id\" href=web.php?page_id=" . $i . ">$i</a> ";
    }
    ?>
</p>
<form>
    标题: <input type="text" value="<?php if ($_REQUEST['title']) {
        echo $_REQUEST['title'];
    } ?>" name="title">
    作者: <input type="text" value="<?php if ($_REQUEST['author']) {
        echo $_REQUEST['author'];
    } ?>" name="author">
    出版社: <input type="text" value="<?php if ($_REQUEST['publisher']) {
        echo $_REQUEST['publisher'];
    } ?>" name="publisher">

    <input type="submit" value="submit">
</form>
<table border="1">
    <tr>
        <th>#</th>
        <th>书名</th>
        <th>作者</th>
        <th>ISBN</th>
        <th>出版社</th>
        <th>出版时间</th>
        <th>页数</th>
    </tr>
    <?php
    /**
     * @var Feiffy\PHPCrawler\Entity\Book $book
     */
    foreach ($books as $book) {
        echo "<tr>";
        echo "<td>" . $book->getId() . "</td>\n";
        echo "<td>" . $book->getTitle() . "</td>\n";
        echo "<td>" . $book->getAuthor() . "</td>\n";
        echo "<td>" . $book->getIsbn() . "</td>\n";
        echo "<td>" . $book->getPublisher() . "</td>\n";
        echo "<td>" . $book->getPublishDate() . "</td>\n";
        echo "<td>" . $book->getPages() . "</td>\n";
        echo "</tr>";
        $i++;
    }
    ?>
</table>
<p>
    <?php
    for ($i = $pages; $i >= 1; $i--) {
        echo " <a id=\"page_id\" href=web.php?page_id=" . $i . ">$i</a> ";
    }
    ?>
</p>
</body>
</html>

