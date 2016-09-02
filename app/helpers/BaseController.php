<?php
namespace App\Helpers;

class BaseController {
  public function render($template, $params) {
    $templatePath = __DIR__ . '/../views/' . $template;
    foreach ($params as $key => $value) {
      $$key = $value;
    }
    if (file_exists($templatePath) === false) {
      throw new Exception('Template not found!');
    }
    require_once $templatePath;
  }
}
