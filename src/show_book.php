<?php
require_once "bootstrap.php";

$id = $argv[1];
$book = $entityManager->find('Feiffy\PHPCrawler\Entity\Book', $id);

if ($book === null) {
    echo "No product found.\n";
    exit(1);
}

echo sprintf("-%s\n", $book->getTitle());