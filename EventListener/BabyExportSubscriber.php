<?php

namespace BabyBundle\EventListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use BabyBundle\Event\BabyExportSendMail;

class BabyExportSubscriber implements EventSubscriberInterface{
  public function __construct( $mailer, EngineInterface $templating ){
    $this->mailer = $mailer;
    $this->templating = $templating;
  }

  public static function getSubscribedEvents(){
    return array(
      BabyExportSendMail::BABYEXPORTSENDMAIL => array(
        array('babyExportSendMail', -10),
        array('babyExportLog', -20),
      )
    );
  }

  public function babyExportSendMail(){
    $message = \Swift_Message::newInstance()
      ->setSubject('Export csv')
      ->setFrom('vdavid@kovalibre.com')
      ->setTo('dev-symfony@openska.com')
      ->setBody(
        $this->templating->render(
          'BabyBundle:Email:export.html.twig',
          array('name' => 'Mon super export csv')
        ),
        'text/html'
      );
      $this->mailer->send($message);
  }

  public function babyExportLog(){

  }
}
