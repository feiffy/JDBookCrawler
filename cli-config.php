<?php
require_once __DIR__ .'/src/bootstrap.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);

# vendor/bin/doctrine orm:schema-tool:update --force --dump-sql