<?php

namespace BabyBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class BabyAddPlayerEvent extends Event{

  const NEWPLAYER = 'baby.newplayer';
  const EDITPLAYER = 'baby.editplayer';

  public function __construct(){
  }
}
