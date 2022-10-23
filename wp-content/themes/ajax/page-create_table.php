<?php
require_once(__DIR__ . '/lib/config.php');
use MyApp\Database;

$table = new Database("restock");
$table->create_table();
$table->insert_table();

?>
テーブルを作成しました。
