<?php

namespace BabyFootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
	$form = $this->createFormBuilder();
	$form->add('title', TextType::class, array("data" => 'Mon titre'))
	     ->add('email', TextType::class, array("data" => "Mon email"))
	     ->add('Enregistrer', SubmitType::class); 
	$form = $form->getForm();

        return $this->render('BabyFootBundle:Default:index.html.twig',
		array(
			'form' => $form->createView(),
		));
    }

    public function menuAction()
    {
	$liste = array(
		array('id' => 1, 'titre' => 'Team', 'route_name' => 'team_index' ),
		array('id' => 2, 'titre' => 'Tournament' , 'route_name' => 'tournament_index'),
		array('id' => 3, 'titre' => 'Player', 'route_name' => 'player_index'),
		array('id' => 4, 'titre' => 'Game', 'route_name' => 'game_index')
	);
	
	return $this->render('BabyFootBundle:Default:menu.html.twig', array(
		'liste' => $liste
	));
    }
}
