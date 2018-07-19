<?php
include_once(__DIR__ . "/autoloader.php");
$setting = [
    'factory',
    'parse.csv',
    'parse.xml'
];
BASE\autoloader::includeClass($setting);
?>