<?php
namespace Controller;

use \W\Controller\Controller;
use Model\OffresModel;

class OffresController extends BaseController
{
	public function event(){

		if ( ! empty($_POST)) {
			$req = $_POST;
		}elseif (!empty($_GET)) {
			$req = $_GET;
		}

		if(!empty($req ) ){
			$columns = array('style_soiree','tranche_age','nbr_participants');
			$criteres = array();
			foreach($columns as $col){
				if(!empty($req[$col]))
					$criteres[$col] = $req[$col]; 
			}
		}else{
			$criteres = array(); 
		}
		$offresModel = new OffresModel();
		$records = $offresModel->search($criteres,'AND');
		$data = array(
			'criteres' => $criteres,
			'records' => $records
		);
		$this->show('offres/events',$data);		
	}
}
