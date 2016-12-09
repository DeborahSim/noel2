<?php

namespace Controller;

use W\Security\AuthentificationModel;

use Model\UtilisateursModel;
use \Respect\Validation\Validator as v;
use \Respect\Validation\Exceptions\NestedValidationException;


class UtilisateursController extends BaseController
{

/**
* 
*/
	public function login() {

		/*
		 on va utiliser le model d'authentification :
		 la methode isValidLoginInfo à laquelle on passera en param
		 le pseudo/email et le password envoye en post par l'utilisateurs
		une fois cette verification faite on, on recupere l'utilisateur en bdd,
		on le connecte et on le redirige vers la page d'accueil
	*/

		if ( ! empty($_POST) && ! empty( $_POST['pseudo'] ) && ! empty( $_POST['mot_de_passe'] ) ) {

			$pseudo = $_POST['pseudo'];
			$password = $_POST['mot_de_passe'];

			// verification du login
			$authentification = new AuthentificationModel();

			$identifiant = $authentification -> isValidLoginInfo($pseudo, $password);

				if ( ! empty($identifiant) ) {

					// recuperation des infos de l'utilisateur
						$usersModel = new UtilisateursModel();

						$usersdonnees = $usersModel -> find($identifiant); 

					// connecte l'indentifiant 
						$authentification -> logUserIn($usersdonnees);

						// retour à la page d'accueil
							$this -> redirectToRoute('default_home');


				} else { 
					// idenfiant = 0;
					// les infos de connection sont incorecte
					$this -> getFlashMessenger()->error('mot de passe ou indentifiant invalide');
					

				}


		} 
			// post = null
			$this -> show( 'utilisateurs/login', array( 'datas' => ( isset( $_POST ) ) ? $_POST : array() ) );
		


	// fin de la fonction login()	
	}

/**
 * fonction logout()
 * fonction qui permet de se deconnecter du site
 * une fois deconnecté on est renvoyé ver l'accueil.
 */

	public function logout() {
		$auth = new AuthentificationModel();
		$auth -> logUserOut();
		$this -> redirectToRoute('default_home');

	// fin de la foncion
	}


/**
* 
*/

	public function register() {

		$erreurs = array(); // tableau qui gere les erreurs

		if (! empty($_POST)) {
			/*
				Verification des données du formulaire

			*/

				// creation des variables tableau pour le controle de l'existance 
				// des données obligatoire
				
				$mini = 2; // longueur minimum des champs : pseudo, nom, prenom
				$maxi = 50; // longueur maximum pour les meme champs
				$maxSize = 1000000; // 976Ko

				// initialisation du tableau pour la verification de l'existance des champs
				$champs = array (
					'pseudo' => 'pseudo',
					'mot_de_passe' => 'mot_de_passe',
					'email' => 'email',
					'nom'	=> 'nom',
					'prenom' => 'prenom',
					'sexe'	=> 'sexe',
					'adresse' => 'adresse',
					'code_postal' => 'code_postal',
					'ville' => 'ville',
					'pays' => 'pays',
					'telephone' => 'telephone',
					'presentation' => 'presentation'
					);

				// rectification de l'erreur du si un code postal n'est pas rentrée 
				$_POST['ville'] = (empty($_POST['ville'])? '' : $_POST['ville'] );

				// verification des de l'existance du champs obligartoire
				foreach ($champs as $clef => $valeur) {
					if ( empty($_POST[$valeur]) && trim($_POST[$valeur]) == '' ) {
						// creation du message d'erreur
							$erreurs[$valeur] = 'Ce champ est obligatoire.';
					}
				}

				
				// verification des longeurs mini et maxi

				$verif_longueur = array (
					'pseudo' => 'pseudo',
					'email' => 'email',
					'nom'	=> 'nom',
					'prenom' => 'prenom',
					'ville' => 'ville',
					'pays' => 'pays',
					);


				foreach ($verif_longueur as  $valeur) {

					if ( ( !empty($_POST[$valeur]) && trim($_POST[$valeur]) !== '' )  &&  ( strlen($_POST[$valeur]) <2 || strlen($_POST[$valeur]) >50 ) ) {
						$erreurs[$valeur] = '- La longueur doit être comprise entre '.$mini.' et '.$maxi.' caractères. -';
					}
					
				// fin du foreach
				}

				// verification de l'existance du pseudo
				$utili_model = new UtilisateursModel;

				$verif_exi_pseud = $utili_model -> usernameExists( $_POST['pseudo'] );
				if ( $verif_exi_pseud  ) { $erreurs['pseudo'] = ' - pseudo deja existant ' ; }

				// verification de la validité de l'email et de l'existance de l'email
					// validité 
					if ( !empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) !== FALSE ) {
						// exitance
						
						if (  $utili_model -> emailExists( $_POST['email'] ) ) { $erreurs['email']='E-mail deja existante.'; }
					}else { $erreurs['email'] = 'E-mail non valide.' ; }

				// verification de la validité du sexe

				if( empty($_POST['sexe']) || ! in_array($_POST['sexe'], ['homme', 'femme'])) { $erreurs['sexe'] = '- Ce choix est inéxistant veuillez le rectifier -';

				// fin de la condition de validation des boutons ratios
				};

				// verification du telephone


				// changement du code postal en numerique au lieu d'un alpha
					if (!empty($_POST['code_postal']) && trim($_POST['code_postal'] !== '' ) )
						{ $_POST['code_postal'] = intval($_POST['code_postal']); }

				$datas = $_POST;

				// verification qu'une image pour la photo à bien été envoyé
				if (! empty($_FILES['photo']['tmp_name']) ) {
					
					// verification que le fichier à bien été téléchargé

					if ( is_uploaded_file( $_FILES['photo']['tmp_name']) ) {
						
						// verification de type MINE
						// on s'assurer du type envoyer par $_FILES
						
						$typeMime = mime_content_type($_FILES['photo']['tmp_name']);
						$typeValide = array('image/jpeg', 'image/png', 'image/gif');

						if (in_array($typeMime, $typeValide)) {
							// si le type MIME est ok on vérifi son poid
							if ($maxSize >= $_FILES['photo']['size']) {
								// on rajoute le chemin du fichier temporaire de la photo si celle-ci existe

								if (!empty($_FILES['photo']['tmp_name'])) {
									// je stock en donnée à valider le chemin vers la localisation
									// temporaire de l'photo
									$datas['photo'] = $_FILES['photo']['tmp_name'];
								} else { $datas['photo'] = ''; } // sinon je laisse le champ vide
								


							// fin de la vérification du poid du fichier
							} else { $erreurs['photo'] = '- Le fichier doit être inferieur à 976Ko -';}
						// fin de la vérification du Type MIME 
						} else { $erreurs['photo'] = '- Ce fichier n\' est pas un fichier : jpeg - png -gif -';
						}
					// fin de la condition de verification du téléchargement de l'image
					} else { $erreurs['photo'] = '- Le fichier ne s\' est pas téléchargé correctement -'; }
			
				// fin de la condition de validation de l photo	
				}

			// si pas d'erreur on insert un nouvel utilisateur
				if ( empty($erreurs) ) {
					// avant l'insertion on doit faire deux choses :
					// Deplacer la photo du fichier temporaire vers son dossier
					// on doit hasher les mot de passe

					$auth = new AuthentificationModel();

					$datas['mot_de_passe'] = $auth -> hashPassword($datas['mot_de_passe']);


					// on depalce la photo vers le dossier photos
					if  ( !empty($_FILES['photo']['tmp_name']) ) {
					$initialPhotoPath = $_FILES['photo']['tmp_name'];
						$photoNewName = md5(time().uniqid());
						$targetPath = realpath('assets/photos_utilisateurs/');

						move_uploaded_file($initialPhotoPath, $targetPath.'/'.$photoNewName);

						// je vais mettre à jour le nouveau nom de la photo dans $datas
						$datas['photo'] = $photoNewName;

					} else { $datas['photo'] = 'photo_utilisateur_default.png' ; }

					// insetion en base de donnée
					$UtilisateursModel = new UtilisateursModel();

					unset($datas['Envoyer']);
					$userInfo = $UtilisateursModel -> insert($datas);
					$auth -> logUserIn($userInfo);
					//$this -> getFlashMessenger() -> success('vous vous êtes bien inscrit');
					// redirection ver le chemin du compte utilisateur
					$this -> redirectToRoute('cptUtilisateur');

				}
		// fin du control du post		
		}
		// chargement de la vue register en envoyant les messages d'erreur
		$this -> show('utilisateurs/register', ['erreurs' => $erreurs] );
	// fin de la fonction register
	}



	public function affich_page() {

		/*
			controler la presence d'une session sinon revoyer ver l'accueil
		*/

			echo('arrivée sur la page affich_page...<br />');

			$authentification = new AuthentificationModel();

			echo('objet authentification instanté...<br />');

			$donnees_utilisateur = $authentification -> getLoggedUser();

			echo('donnée recuperés...<br />');


			if ( $donnees_utilisateur !== NULL ) {

				var_dump($donnees_utilisateur);
				

				/*
					recupere l'id de l'utilisateur et initialisation de l'objet UtilisateursModel()
				*/
					$id_utilisateur = $donnees_utilisateur['id'];
					$mod_util = new UtilisateursModel();

				/*
					verification si une annonce à ete posté par l'utilisateur
				*/

					

					 $resultat_offre = $mod_util -> rch_offre_utilisateur_id($id_utilisateur);

					 echo('affichage du retour de base de donnée : ');

					 var_dump($resultat_offre);

					 exit;

					 // verification s'il a posté une offre
					 	if ( $resultat_offre !== false ){

					 		// recuperation des données afin de les restructurer
					 			$status = "1"; // 1 pour dire qu'il à poste une offre
					 			
					 			$donnees_utilisateur = array_push($donnees_utilisateur, $status);
					 			$donnees_offre =  array();






					 	}

				/*
					verification s'il participe à une offre
				*/
					$resultat_participation = $mod_util -> rch_participe_utilisateur_id($id_utilisateur);

					echo('affichage du resultat des participations aux soirées :');
					var_dump($resultat_participation);
					exit;

					// verification de l'existance d'un participation
						if ( $resultat_participation !== false ) {


						}

				/*
					aucune offre ni participation
				*/



				




			// fin du controle de l'existance d'une session	
			}
			$this -> redirectToRoute('/default_home');


	// fin fonction affich_page
	}

}