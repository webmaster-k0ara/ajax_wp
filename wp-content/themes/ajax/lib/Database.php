<?php

namespace MyApp;

class Database
{
  private $table_name;
  public function __construct($table_name, $email, $prod)
  {
    $this->table_name = $table_name;
    $this->email = $email;
    $this->prod = $prod;
  }
  // create
  public function create_table($table_name)
  {
    global $wpdb;
    //テーブル名がなかったら
    if ($wpdb->get_var("show tables like '" . $wpdb->prefix . $table_name . "'") != $wpdb->prefix . $table_name) {

      //dbDelta 関数の読み込み
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

      //テーブル生成
      $sql = "CREATE TABLE " . $wpdb->prefix . $table_name . "(
        id int not null auto_increment,
        email text not null,
        prod text not null,
        primary key(id)
        );";
      add_option($table_name . "_version", '1.0');
      dbDelta($sql);
    }
  }

  // insert
  public function insert_table($table_name, $email, $prod)
  {
    global $wpdb;
    $this->tablename = "restock";
    $this->email = "aaa@mail.com";
    $this->prod = "ec1234";
    $sql = $wpdb->prepare("INSERT INTO " . $wpdb->prefix . $this->tablename . " (email, prod) VALUES (%s , %s)", $this->email, $this->prod);
    $wpdb->query($sql);
  }
}
