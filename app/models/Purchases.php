<?php
namespace App\Models;
use App\Helpers\DB;
class Purchases {
  protected $db = null;
  function __construct() {
    $this->db = DB::getInstance()->getConnection();
  }
  public function getSalesMonth() {
    $sql = 'SElECT platform, COUNT(id) as `count` FROM purchases
            WHERE DATE(created_datetime) > CURDATE() - INTERVAL 30 DAY
            GROUP BY platform';
    $q = $this->db->prepare($sql);
    $q->execute();
    $res = $q->fetchAll(\PDO::FETCH_ASSOC);
    $data = [];
    foreach ($res as $value) {
      $data[$value['platform']] = $value['count'];
    }
    return $data;
  }

  public function getSalesMonthPercent() {
    $sql = 'SElECT COUNT(*) FROM purchases';
    $q = $this->db->prepare($sql);
    $q->execute();
    $count = $q->fetchColumn();
    $sales = $this->getSalesMonth();
    $data = [];
    foreach ($sales as $key => $value) {
      $data[$key] = number_format(($value * 100 / $count), 2) ;
    }
    return $data;
  }

  public function getAveragePurchasesPerDay() {
    $sql = 'SELECT DATE(`created_datetime`) as `date`, platform, DATEDIFF(purchases.created_datetime, users.registration_datetime) as days
            FROM `purchases`
            INNER JOIN users ON users.id = purchases.user_id
            WHERE DATE(`created_datetime`) > CURDATE() - INTERVAL 30 DAY';
    $q = $this->db->prepare($sql);
    $q->execute();
    $data = $q->fetchAll(\PDO::FETCH_ASSOC);
    $days = [];
    $result = [];
    for($i = 0; $i < 30; $i++) {
      array_push($days, date('Y-m-d',strtotime("-$i day", time())));
    }
    $data = array_reduce($data, function($curr, $value) {
      if(!$curr[$value['platform']]) {
        $curr[$value['platform']] = [];
      }
      if(!$curr[$value['platform']][$value['date']]) {
        $curr[$value['platform']][$value['date']] = [
          'sum' => 0,
          'count' => 0
        ];
      }
      $curr[$value['platform']][$value['date']]['sum'] += $value['days'];
      $curr[$value['platform']][$value['date']]['count']++;
      return $curr;
    }, []);
    foreach ($data as $k => $v) {
      foreach ($days as $d) {
        if($data[$k][$d]) {
          $result[$k][] = (float) number_format($data[$k][$d]['sum'] / $data[$k][$d]['count'], 2);
        } else {
          $result[$k][] = 0;
        }
      }
    }
    return [
      'title' => $days,
      'data' => $result
    ];
  }
}
