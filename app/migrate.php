<?php
require_once __DIR__ . '/helpers/Db.php';
use App\helpers\Db as DB;
$dbh = DB::getInstance()->getConnection();
try {
  $dbh->query('CREATE TABLE IF NOT EXISTS users(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    registration_datetime TIMESTAMP
  ) CHARACTER SET utf8');

  $dbh->query('CREATE TABLE IF NOT EXISTS purchases(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED NOT NULL,
    platform VARCHAR(30) NOT NULL,
    created_datetime TIMESTAMP
  ) CHARACTER SET utf8');

  $dbh->query('ALTER TABLE purchases ADD INDEX (user_id);');

  $dbh->query('ALTER TABLE purchases ADD INDEX (user_id);');

  $dbh->query('ALTER TABLE purchases ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE RESTRICT;');

  $dbh->query('INSERT INTO users (username) VALUES
   (\'Andrew\'),
   (\'John\')');

  $date = date('Y-m-d h:m:s',time() - 60 * 60 * 24 * 5);
  $dbh->query("INSERT INTO users (username, registration_datetime ) VALUES
   ('Paul', '$date'),
   ('Rodriguez', '$date'),
   ('Samanta', '$date')");

  $dbh->query('INSERT INTO purchases (user_id, platform) VALUES
  (1, \'Mac OS\'),
  (1, \'Android\'),
  (3, \'Android\'),
  (2, \'Linux\'),
  (2, \'IOS\')');

  $date = date('Y-m-d h:m:s',time() - 60 * 60 * 24 * 3);
  $dbh->query("INSERT INTO purchases (user_id, platform, created_datetime) VALUES
  (3, 'Mac OS','$date' ),
  (3, 'Android', '$date'),
  (4, 'Linux', '$date'),
  (4, 'IOS', '$date')");

  $date = date('Y-m-d h:m:s',time() - 60 * 60 * 25 * 1);
  $dbh->query("INSERT INTO purchases (user_id, platform, created_datetime) VALUES
  (3, 'Mac OS','$date' ),
  (4, 'Android', '$date')");

  echo 'Migration completed!' . PHP_EOL;
} catch (Exception $e) {
  echo $e->getMessage();
}
