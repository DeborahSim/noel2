<?php

namespace Model;

use W\Model\UsersModel;


class Relation_contactModel extends UsersModel 
{

	/**
	 * fonction qui retrouve le nombre de participant à une offre
	 * @param int id_offre; id de l'offre
	 * @return mixte le nombre de participant ou false si personne
	 */
		public function nbr_participant($id_offre) {
			//creation de la requete
				$requete = 'SELECT count(*) AS nbr_participant FROM '.$this -> table.' JOIN offres ON '. $this -> table .'.id_offre = offres.id WHERE '.$this -> table.'.id_offre = '.$id_offre;

		}
	


	


// fin de la class UtilisateursModel	
}