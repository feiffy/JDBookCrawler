<?php
require_once "bootstrap.php";

$id       = $argv[1];
$newTitle = $argv[2];
$book     = $entityManager->find('Feiffy\PHPCrawler\Entity\Book', $id);

if ($book === null) {
    echo "Book $id does not exist.\n";
    exit(1);
}

$book->setTitle($newTitle);
$entityManager->flush();