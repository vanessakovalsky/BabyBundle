<?php

namespace BabyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BabyBundle\Entity\Joueur;
use BabyBundle\Form\JoueurType;
use BabyBundle\Event\BabyAddPlayerEvent;

/**
 * Joueur controller.
 *
 * @Route("/joueur")
 */
class JoueurController extends Controller
{
    /**
     * Lists all Joueur entities.
     *
     * @Route("/", name="joueur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $joueurs = $em->getRepository('BabyBundle:Joueur')->findAll();
        $joueur_equipe = array();
        foreach ($joueurs as $joueur){
          $joueur_equipe[$joueur->getid()] = $em->getRepository('BabyBundle:Joueur')->findTeamName($joueur);
        }
        return $this->render('BabyBundle:Joueur:index.html.twig', array(
            'joueurs' => $joueurs,
            'joueurs_equipe_name' => $joueur_equipe
        ));
    }

    /**
     * Creates a new Joueur entity.
     *
     * @Route("/new", name="joueur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
      $event = new BabyAddPlayerEvent();
        // $eventDispatcher = $this->get('event_dispatcher');
        // $eventDispatcher->dispatch(BabyAddPlayerEvent::NEWPLAYER, $event);
        $joueur = new Joueur();
        $form = $this->createForm('BabyBundle\Form\JoueurType', $joueur);
        $form->handleRequest($request);
        var_dump($form->isSubmitted());

        if ($form->isSubmitted() && $form->isValid()) {
          var_dump('formulaire soumis');
            $em = $this->getDoctrine()->getManager();
            $em->persist($joueur);
            $em->flush();

            return $this->redirectToRoute('joueur_show', array('id' => $joueur->getId()));
        }

        $response = $this->render('BabyBundle:Joueur:new.html.twig', array(
            'joueur' => $joueur,
            'form' => $form->createView(),
        ));
        //$response->headers->set('Method', 'PURGE');
        return $response;
    }

    /**
     * Finds and displays a Joueur entity.
     *
     * @Route("/{id}", name="joueur_show")
     * @Method("GET")
     */
    public function showAction(Joueur $joueur)
    {
        $deleteForm = $this->createDeleteForm($joueur);

        return $this->render('joueur/show.html.twig', array(
            'joueur' => $joueur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Joueur entity.
     *
     * @Route("/{id}/edit", name="joueur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Joueur $joueur)
    {
        $deleteForm = $this->createDeleteForm($joueur);
        $editForm = $this->createForm('BabyBundle\Form\JoueurType', $joueur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($joueur);
            $em->flush();

            return $this->redirectToRoute('joueur_edit', array('id' => $joueur->getId()));
        }

        return $this->render('joueur/edit.html.twig', array(
            'joueur' => $joueur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Joueur entity.
     *
     * @Route("/{id}", name="joueur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Joueur $joueur)
    {
        $form = $this->createDeleteForm($joueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($joueur);
            $em->flush();
        }

        return $this->redirectToRoute('joueur_index');
    }

    /**
     * Creates a form to delete a Joueur entity.
     *
     * @param Joueur $joueur The Joueur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Joueur $joueur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('joueur_delete', array('id' => $joueur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/ws/add-player/{nom}/{prenom}/{email}")
     *
     */
    public function AddPlayerAction($nom, $prenom, $email, Request $request)
    {
    	$player = new Joueur();
    	$player->setNom($nom);
    	$player->setPrenom($prenom);
    	$player->setEmail($email);
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($player);
    	$em->flush();
    	return new Response('ok');
    }
}
