<?php

namespace BabyFootBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BabyFootBundle\Entity\Tournament;
use BabyFootBundle\Form\TournamentType;

/**
 * Tournament controller.
 *
 * @Route("/tournament")
 */
class TournamentController extends Controller
{
    /**
     * Lists all Tournament entities.
     *
     * @Route("/", name="tournament_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tournaments = $em->getRepository('BabyFootBundle:Tournament')->findAll();

        return $this->render('BabyFootBundle:Tournament:index.html.twig', array(
            'tournaments' => $tournaments,
        ));
    }

    /**
     * Creates a new Tournament entity.
     *
     * @Route("/new", name="tournament_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tournament = new Tournament();
        $form = $this->createForm('BabyFootBundle\Form\TournamentType', $tournament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tournament);
            $em->flush();

            return $this->redirectToRoute('tournament_show', array('id' => $tournament->getId()));
        }

        return $this->render('BabyFootBundle:Tournament:new.html.twig', array(
            'tournament' => $tournament,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tournament entity.
     *
     * @Route("/{id}", name="tournament_show")
     * @Method("GET")
     */
    public function showAction(Tournament $tournament)
    {
		$deleteForm = $this->createDeleteForm($tournament);
		$tournament_players = $this->getDoctrine()->getManager()->getRepository('BabyFootBundle:Tournament')->findPlayerByTournament($tournament->getId());
	//die(var_dump($tournament_players));
        return $this->render('tournament/show.html.twig', array(
            'tournament' => $tournament,
	    'tournament_player' => $tournament_players,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tournament entity.
     *
     * @Route("/{id}/edit", name="tournament_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tournament $tournament)
    {
        $deleteForm = $this->createDeleteForm($tournament);
        $editForm = $this->createForm('BabyFootBundle\Form\TournamentType', $tournament);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tournament);
            $em->flush();

            return $this->redirectToRoute('tournament_edit', array('id' => $tournament->getId()));
        }

        return $this->render('tournament/edit.html.twig', array(
            'tournament' => $tournament,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Tournament entity.
     *
     * @Route("/{id}", name="tournament_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tournament $tournament)
    {
        $form = $this->createDeleteForm($tournament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tournament);
            $em->flush();
        }

        return $this->redirectToRoute('tournament_index');
    }

    /**
     * Creates a form to delete a Tournament entity.
     *
     * @param Tournament $tournament The Tournament entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tournament $tournament)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tournament_delete', array('id' => $tournament->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
