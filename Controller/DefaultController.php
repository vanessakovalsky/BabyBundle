<?php

namespace BabyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {

      $custom_logger = $this->get('baby.logger');
      $custom_logger->writeLog('Affiche la page d\'accueil');

      $response = $this->render('BabyBundle:Default:index.html.twig');
      // Set cache settings in one call
      $response->setCache(array(
          'etag'          => 'index',
          //'last_modified' => date(),
          'max_age'       => 10,
          's_maxage'      => 10,
          'public'        => true,
          // 'private'    => true,
      ));

       return $response;
    }

    /**
     * @Route("/homepage")
     */
    public function homeAction()
    {
      //$user = $this->get('security.token_storage')->getToken()->getUser();
      //if(isset($user)){
        //$this->denyAccessUnlessGranted('ROLE_USER', null, 'Pas de role admin');
      //}
    	$response = new Response();
    	$response->setContent(json_encode(array(
    		'data' => 'phrase fkhdqkghqkjfgqh',
    	)));
    	$response->headers->set('Content-type', 'application/json');
      $response->setCache(array(
          'etag'          => 'index',
          //'last_modified' => date(),
          'max_age'       => 3600,
          's_maxage'      => 10,
          'public'        => true,
          // 'private'    => true,
      ));
    	return $response;
    }
}
