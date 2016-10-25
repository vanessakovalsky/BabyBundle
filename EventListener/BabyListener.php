<?php

namespace BabyBundle\EventListener;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\DependencyInjection\ContainerInterface;
use BabyBundle\Event;

class BabyListener{

  protected $service_container;

  public function __construct(ContainerInterface $ServiceContainer){
    return $this->service_container = $ServiceContainer;
  }

  public function logNewPlayer(){
    $logManager = $this->service_container->get('baby.logger');
    $logManager->writeLog('Ajout d\'un nouveau joueur');
  }

}
