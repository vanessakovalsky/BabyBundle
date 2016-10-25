<?php

namespace BabyBundle\EventListener;

use BabyBundle\Event\BabyAddPlayerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BabySubscriber implements EventSubscriberInterface{

  public function __construct(){
  }

  public static function getSubscribedEvents(){
    return array(
      BabyAddPlayerEvent::NEWPLAYER  => array(
        array('sendNewPlayerEmail', -16),
        array('updateMail', -15),
      ),
    );
  }

  public function sendNewPlayerEmail(){
    var_dump('dans la fonction sendNewPlayer');
    // Code métier pour l'envoi de mail
  }

  public function updateMail(){
    var_dump('dans update mail');
  }

}
