<?php
require_once "bootstrap.php";

$newBookTitle = $argv[1];

$book = new \Feiffy\PHPCrawler\Entity\Book();
$book->setTitle($newBookTitle);

$entityManager->persist($book);
$entityManager->flush();

echo "Created Book with ID " . $book->getId() . "\n";