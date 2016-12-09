<?php

namespace Controller;

use \W\Controller\Controller;
use Model\OffresModel;
use \Plasticbrain\FlashMessages\FlashMessages;

class BaseController extends Controller
{

	
	// déclaration d'une variable de class
	/*
	*	ce champs va contenire l'engine de Plates qui va servir à afficher mes vues
	*/
		protected $engine;

	/**
	 * Ce champ va contenir une instance du flash messenger de php-flash-messages
	 */
		protected $fmsg;



	
	// redifinition complete de la fonction __construct()
	public function __construct() {

		/*
		je fais appel à la méthode __construct() de la classe parente (controller) ce qui me permet de 
		surcharger cette méthode et non de la redéfinir entièrement
		*/
			// parent::__construct(); 

		/* je stock dans la variable de class engine une instance de League/Plates/Engines alors que cette instance
			était créee directement dans la méthode show() de Controller
		*/
			$this -> engine = new \League\Plates\Engine(self::PATH_VIEWS);

			//charge nos extensions (nos fonctions personnalisées)
			$this -> engine -> loadExtension(new \W\View\Plates\PlatesExtensions());

			$app = getApp();


			$this -> fmsg = new FlashMessages();

			// Rend certaines données disponibles à tous les vues
			// accessible avec $w_user & $w_current_route dans les fichiers de vue
			$this -> engine -> addData(
				[
					'w_user' 		  => $this->getUser(),
					'w_current_route' => $app->getCurrentRoute(),
					'w_site_name'	  => $app->getConfig('site_name'),
					'fmsg'			  => $this -> getFlashMessenger()
				]
			);

			
		// fin de la fonction __construct()
		}

	public function show( $file, array $data = array() ) {

		// Retire l'éventuelle extension .php
		$file = str_replace('.php', '', $file);

		// Affiche le template
		echo $this -> engine->render($file, $data);
		die();
	// fin de la fonction show
	}



	/**
	 * retourne une instance du flash messenger du php-flash-messages
	 * @return FlashMessages
	 */

	public function getFlashMessenger() {
		return $this -> fmsg;
	}

}