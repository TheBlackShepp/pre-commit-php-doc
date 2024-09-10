<?php

require_once "FilePhp.php";

foreach (glob(__DIR__ . '/Types/*.php') as $file) {
    require_once $file;
}

foreach (glob(__DIR__ . '/PartsCode/*.php') as $file) {
    require_once $file;
}
