<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once 'index.php';

$isDevMode = true;
$config    = Setup::createAnnotationMetadataConfiguration(array(APP_PATH . 'src/Entity/'), $isDevMode);

$conn = 'configs/db.php';

$entityManager = EntityManager::create($conn, $config);