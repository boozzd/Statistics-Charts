<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>User statistics</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="/public/bootstrap/dist/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <div id="funnel" data-series='<?php echo json_encode($conversion)?>'></div>
        </div>
        <div class="col-sm-6">
          <div id="area" data-series='<?php echo json_encode($purchases)?>'></div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div id="pie" data-series='<?php echo json_encode($purchases_percentage)?>'></div>
        </div>
        <div class="col-sm-6">
          <div id="chart" data-series='<?php echo json_encode($average)?>'></div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="/public/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/public/highcharts/highcharts.js"></script>
    <script type="text/javascript" src="/public/highcharts/modules/funnel.js"></script>
    <script type="text/javascript" src="/public/main.js"></script>
  </body>
</html>
