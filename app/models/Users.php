<?php
namespace App\Models;
use App\Helpers\DB;
class Users {
  protected $db = null;
  function __construct() {
    $this->db = DB::getInstance()->getConnection();
  }

  public function getConversion() {
    $sql = 'SElECT users.*, COUNT(purchases.user_id) as p_count FROM users
            LEFT JOIN purchases ON users.id = purchases.user_id
            WHERE DATE(registration_datetime) > CURDATE() - INTERVAL 30 DAY
            GROUP BY users.id';
    $q = $this->db->prepare($sql);
    $q->execute();
    $data = $q->fetchAll(\PDO::FETCH_ASSOC);
    $bought = array_reduce($data, function ($curr, $value) {
      if ($value['p_count'] > 0) {
        return ++$curr;
      }
      return $curr;
    }, 0);
    return [
      'Registered' => count($data),
      'Bought' => $bought
    ];
  }
}
