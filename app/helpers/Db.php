<?php
namespace App\Helpers;

class Db {
  protected static $instance;
  protected $connection = null;

  public static function getInstance() {
      if (!isset(static::$instance)) {
          static::$instance = new static;
      }
      return static::$instance;
  }

  public function getConnection() {
    if ($this->connection) {
      return $this->connection;
    }
    try {
      require_once __DIR__ . '/../config/config.php';
      $this->connection = new \PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['database'], $config['db']['user'], $config['db']['pass']);
    } catch (PDOException $e) {
      echo 'Connection with database is not establishment! ' . $e->getMessage();
      exit();
    }
    return $this->connection;
  }
}
