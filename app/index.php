<?php
namespace App;
function autoload($className) {
  $className = ltrim($className, '\\');
  $fileName  = '';
  $namespace = '';
  $firstPos = strpos($className, '\\');
  $lastPos = strrpos($className, '\\');
  $namespace = substr($className, $firstPos, $lastPos - $firstPos);
  $className = substr($className, $lastPos + 1);
  $fileName = strtolower(str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR);
  $fileName .= $className . '.php';
  require __DIR__ . $fileName;
}
spl_autoload_register('App\autoload');

use App\Controllers\Index as IndexController;
$contr = new IndexController();
$contr->index();
