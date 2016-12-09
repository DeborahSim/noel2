<?php
 
namespace Controller;

use \W\Controller\Controller;
use Model\OffresModel;

class DefaultController extends BaseController
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
		$om = new OffresModel();
		$resultat = $om->searchDerniersOffres();
		if($resultat==false){
			$resultat='';
		}



		$this->show('default/home', array($resultat));
	}

	/**
	 * Page sur les principes
	 */
	public function principe()
	{
		$this->show('default/principe');
	}


	public function evenementFamille()
	{
		$famille = 'familiale';
		$this->redirectToRoute('/events', array('style_soiree' => $famille));
	}


}


