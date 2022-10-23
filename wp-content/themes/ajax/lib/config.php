
<?php
require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/wp-load.php');


spl_autoload_register(function($class) {
  $prefix = 'MyApp\\';
  if(strpos($class,$prefix) === 0) {
    $fileName = sprintf(__DIR__ . '/%s.php',substr($class,strlen($prefix)));
    if(file_exists($fileName)){
      require($fileName);
    }else {
      echo 'File not found: ' . $fileName;
      exit;
    }
  }
});
