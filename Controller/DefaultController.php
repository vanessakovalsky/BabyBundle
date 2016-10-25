<?php

namespace BabyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
      $custom_logger = $this->get('baby.logger');
      $custom_logger->writeLog('Affiche la page d\'accueil');
        return $this->render('BabyBundle:Default:index.html.twig');
    }

    /**
     * @Route("/homepage/{numero}/{nom}")
     */
    public function homeAction($numero, $nom, Request $request)
    {
	$response = new Response();
	$response->setContent(json_encode(array(
		'data' => 'mes supers datas en json qui sont trop longues',
	)));
	$response->headers->set('Content-type', 'application/json');
	return $response;
    }
}
