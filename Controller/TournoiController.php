<?php

namespace BabyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BabyBundle\Entity\Tournoi;
use BabyBundle\Form\TournoiType;

/**
 * Tournoi controller.
 *
 * @Route("/tournoi")
 */
class TournoiController extends Controller
{
    /**
     * Lists all Tournoi entities.
     *
     * @Route("/", name="tournoi_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tournois = $em->getRepository('BabyBundle:Tournoi')->findAll();

        return $this->render('tournoi/index.html.twig', array(
            'tournois' => $tournois,
        ));
    }

    /**
     * Creates a new Tournoi entity.
     *
     * @Route("/new", name="tournoi_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tournoi = new Tournoi();
        $form = $this->createForm('BabyBundle\Form\TournoiType', $tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tournoi);
            $em->flush();

            return $this->redirectToRoute('tournoi_show', array('id' => $tournoi->getId()));
        }

        return $this->render('BabyBundle:Tournoi:new.html.twig', array(
            'tournoi' => $tournoi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tournoi entity.
     *
     * @Route("/{id}", name="tournoi_show")
     * @Method("GET")
     */
    public function showAction(Tournoi $tournoi)
    {
        $deleteForm = $this->createDeleteForm($tournoi);
	$teams = $this->getDoctrine()->getManager()->getRepository('BabyBundle:Tournoi')->findTeamsByTournament($tournoi->getId());

	$games_tournament = $tournoi->getGames();
	foreach($games_tournament as $game)
	{
	$game_id[] = $game->getId();
	}
	$games = $this->getDoctrine()->getManager()->getRepository('BabyBundle:Game')->findById($game_id);
        return $this->render('tournoi/show.html.twig', array(
            'tournoi' => $tournoi,
	    'teams' => $teams,
	    'games' => $games,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tournoi entity.
     *
     * @Route("/{id}/edit", name="tournoi_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tournoi $tournoi)
    {
        $deleteForm = $this->createDeleteForm($tournoi);
        $editForm = $this->createForm('BabyBundle\Form\TournoiType', $tournoi);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tournoi);
            $em->flush();

            return $this->redirectToRoute('tournoi_edit', array('id' => $tournoi->getId()));
        }

        return $this->render('tournoi/edit.html.twig', array(
            'tournoi' => $tournoi,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Tournoi entity.
     *
     * @Route("/{id}", name="tournoi_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tournoi $tournoi)
    {
        $form = $this->createDeleteForm($tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tournoi);
            $em->flush();
        }

        return $this->redirectToRoute('tournoi_index');
    }

    /**
     * Creates a form to delete a Tournoi entity.
     *
     * @param Tournoi $tournoi The Tournoi entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tournoi $tournoi)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tournoi_delete', array('id' => $tournoi->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
