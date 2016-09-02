<?php
namespace App\Controllers;

use App\Helpers\BaseController;
use App\Models\Users as UsersModel;
use App\Models\Purchases as PurchasesModel;

class Index  extends BaseController{
  public function index() {
    $users_model = new UsersModel();
    $conversion = $users_model->getConversion();
    $purchases_model = new PurchasesModel();
    $purchases = $purchases_model->getSalesMonth();
    $purchases_percentage = $purchases_model->getSalesMonthPercent();
    $average = $purchases_model->getAveragePurchasesPerDay();
    $params = [
      'conversion' => $conversion,
      'purchases' => $purchases,
      'purchases_percentage' => $purchases_percentage,
      'average' => $average
    ];
    $this->render('index.php', $params);
  }
}
