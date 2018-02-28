<?php

define('DBHOST', '127.0.0.1');
define('DBNAME', 'hr');
define('DBUSER', 'hr');
define('DBPASS', 'hrtest');

/*
function db() {
    $db = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $db->set_charset('utf8');

    if ($db->connect_errno) {
        echo "Извините, возникла проблема на сайте";
        // debug
        echo "Ошибка: Не удалсь создать соединение с базой MySQL: \n";
        echo "Номер ошибки: " . $db->connect_errno . "\n";
        echo "Ошибка: " . $db->connect_error . "\n";
        exit;
    }
    return $db;
}
*/