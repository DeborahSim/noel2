<?php

namespace Model;

use W\Model\UsersModel;


class UtilisateursModel extends UsersModel 
{

	/**
	 * fonction pour rechercher un utilisateur par son 
	 * ID avec une jointure de la base offres
	 * @param $id l'id de l'utilisateur
	 * @return mixte, les donnes de l'offre que l'utilisateur à posté ou false si rien
	 */

		public function rch_offre_utilisateur_id($id) {

			
			// creation de la requete
			$sql = 'SELECT offres.id AS id_offre, offres.titre_soiree, offres.style_soiree, offres.theme_soiree, offres.participation, offres.tranche_age, offres.geolocalisation, offres.nbr_participants   FROM '. $this->table.' JOIN offres ON offres.id_utilisateur = '.$this->table.'.id WHERE '.$this->table.'.id = :id ';
			$sth = $this->dbh->prepare($sql);
			$sth -> bindValue(':id',$id );
			$sth -> execute();

			return $sth -> fetch();
		// fin de la fonction
		}


	


// fin de la class UtilisateursModel	
}