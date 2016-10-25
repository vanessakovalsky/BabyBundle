<?php
namespace BabyBundle\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class LogManagerFactory{
  public function createLogManager(RequestStack $requestStack){
    $logManager = new LogManager($requestStack);
    return $logManager;
  }
}
