<?php

namespace BabyBundle\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class LogManager{

  protected $requestStack;

  public function __construct( RequestStack $requestStack){
      $this->requestStack = $requestStack;
  }

  public function writeLog($messageToWrite){
    $messageToWrite .= $this->requestStack->getCurrentRequest();
    $log_file = file_put_contents('/var/www/html/sf/demo_sf/var/logs/baby.log', $messageToWrite, FILE_APPEND);
  }
}
