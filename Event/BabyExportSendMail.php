<?php

namespace BabyBundle\Event;
use Symfony\Component\EventDispatcher\Event;

class BabyExportSendMail extends Event {
  const BABYEXPORTSENDMAIL = 'baby.export.send.mail';

  public function __construct(){
  }
}
