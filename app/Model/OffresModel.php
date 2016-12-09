<?php
namespace Model;

use W\Model\Model;


class OffresModel extends Model 
{
	 
	 public function findAll(){
	 	
	 }



	   public function searchDerniersOffres(){
        // On récupère les 3  derniers offres

        $requete = ' SELECT id, titre_soiree, style_soiree, theme_soiree, participation, tranche_age '
                   .'  nbr_participants, id_utilisateur, photo '
                   .'  FROM '
                   . $this->table .' ORDER BY id DESC LIMIT 3';

        $resultat = $this -> dbh -> query($requete);
        return $resultat -> fetchAll();
    }


	/**
	 * Effectue une recherche
	 * @param array $data Un tableau associatif des valeurs à rechercher
	 * @param string $operator La direction du tri, AND ou OR
	 * @param boolean $stripTags Active le strip_tags automatique sur toutes les valeurs
	 * @return mixed false si erreur, le résultat de la recherche sinon
	 */
	public function search(array $search, $operator = 'OR', $stripTags = true){

		// Sécurisation de l'opérateur
		$operator = strtoupper($operator);
		if($operator != 'OR' && $operator != 'AND'){
			die('Error: invalid operator param');
		}

        	$sql = 'SELECT * FROM ' . $this->table.' WHERE';
                
		foreach($search as $key => $value){
			if($key == "nbr_participants"){
				$sql .= " `$key` <= :$key ";
			}else{
				$sql .= " `$key` LIKE :$key ";
			}
			$sql .= $operator;
		}

		// Supprime les caractères superflus en fin de requète
		if($operator == 'OR') {
			$sql = substr($sql, 0, -3);
		}
		elseif($operator == 'AND') {
			$sql = substr($sql, 0, -4);
		}

		$sth = $this->dbh->prepare($sql);

$sqldebug = $sql;

		foreach($search as $key => $value){
			$value = ($stripTags) ? strip_tags($value) : $value;
			if($key == "nbr_participants"){
				$sth->bindValue(':'.$key, $value);
$sqldebug = str_replace(":$key","$value",$sqldebug);
			}else{
				$sth->bindValue(':'.$key, '%'.$value.'%');
$sqldebug = str_replace(":$key","%$value%",$sqldebug);				
			}
			
		}
echo $sqldebug;

		if(!$sth->execute()){
			return false;
		}
        return $sth->fetchAll();
	}
// fin de la class UtilisateursModel	
}
