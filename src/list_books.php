<?php
require_once "bootstrap.php";

$bookRepo = $entityManager->getRepository('Feiffy\PHPCrawler\Entity\Book');

$books = $bookRepo->findAll();
foreach ($books as $book) {
    echo sprintf("-%s\n", $book->getTitle());
}
