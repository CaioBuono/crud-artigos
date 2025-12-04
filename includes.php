<?php
session_start();

define('ROOT', dirname(__FILE__));
define('CAMINHO_TEMPLATE', ROOT . '/tema/template/');
define('CAMINHO_LAYOUT', ROOT . '/tema/layout/');

require_once ROOT . '/autoload/autoload.php';