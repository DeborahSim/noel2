<?php 
 /*
	Fichier d'inscription qui retournera sur la compte 
 */
?>

<?php $this ->layout('layout', ['title' => 'Inscription']) ?>

<?php

	
// affichage des valeurs du formulaire dans le formulaire l'or d'un réafichage suite à une erreur de saisie
	function afficherPost($champ) {
		echo ( ( ! empty($_POST[$champ]) )? $_POST[$champ] : '');
	}


// affichage de CHECKED dans les boutons radio si celui-ci à été validé
	function afficherCheck($valeurAttendue) {
		 echo ( (!empty($_POST['sexe'])) && ($_POST['sexe'] == $valeurAttendue)? 'CHECKED' : '' );

	}
?>

<?php $this -> start('main_content'); ?>

<h4 class="panel">Informations personnelles</h4>

	<div class="panel">
		<form class="form-control" action="<?php echo $this->url('register'); ?>" method="post" enctype="multipart/form-data" >
			<p>
				<label for="pseudo">Pseudo<span> *</span></label>
				<input type="text" name="pseudo" id="pseudo" value="<?php afficherPost('pseudo') ?>" placeholder="Max. 50 caractères" />
				<?php  if(!empty($erreurs['pseudo']) ) { echo('<p class="erreur" >'.$this -> e($erreurs['pseudo']).'</p>'); } ?>
			</p>
			<p>
				<label for="mot_de_passe">Mot de passe<span> *</span></label>
				<input type="password" class="password" name="mot_de_passe" id="mot_de_passe" value="<?php afficherPost('mot_de_passe') ?>" />
				<?php  if(!empty($erreurs['mot_de_passe']) ) { echo('<p  class="erreur" >'.$this -> e($erreurs['mot_de_passe']).'</p>'); } ?>
			</p>

			<p>
				<label for="email">E-mail<span> *</span></label>
				<input type="email" name="email" id="email" value="<?php afficherPost('email') ?>" />
				<?php  if(!empty($erreurs['email']) ) { echo('<p class="erreur" >'.$this -> e($erreurs['email']).'</p>'); } ?>
			</p>
			<p>
				<label for="nom">Nom<span> *</span></label>
				<input type="text" name="nom" id="nom" value="<?php afficherPost('nom') ?>"/>
				<?php  if(!empty($erreurs['nom']) ) { echo('<p class="erreur" >'.$this -> e($erreurs['nom']).'</p>'); } ?>
			</p>
			<p>
				<label for="prenom">Prénom<span> *</span></label>
				<input type="text" name="prenom" id="prenom" value="<?php afficherPost('prenom') ?>" />
				<?php  if(!empty($erreurs['prenom']) ) { echo('<p class="erreur" >'.$this -> e($erreurs['prenom']).'</p>'); } ?>
			</p>
			<p>
				<label class="nostar" for="sexe">Sexe</label>
				<select name = "sexe" id = "sexe" >
					<option value = "homme" <?php afficherCheck('homme') ?> >Homme</option>
					<option value = "femme" <?php afficherCheck('femme') ?> >Femme</option>
				</select>
				<?php  if(!empty($erreurs['sexe']) ) { echo('<p class="erreur" >'.$this -> e($erreurs['sexe']).'</p>'); } ?>
			</p>
			<p>
				<label for="adresse">Adresse<span> *</span></label>
				<input type="text" name="adresse" id="adresse" value="<?php afficherPost('adresse') ?>" />
				<?php  if(!empty($erreurs['adresse']) ) { echo('<p class="erreur" >'.$this -> e($erreurs['adresse']).'</p>'); } ?>
			</p>
			<p>
				<label for="code_postal">Code postal<span> *</span></label>
				<input type="text" name="code_postal" id="code_postal" value="<?php afficherPost('code_postal') ?>" />
				<?php  if(!empty($erreurs['code_postal']) ) { echo('<p class="erreur" >'.$this -> e($erreurs['code_postal']).'</p>'); } ?>

				<select id="selectVille" name="ville" value="<?php afficherPost('ville') ?>" >
					<!--
						 Ici nous mettons les options pour l'affichage des codes postals

					-->
				</select>
				<?php  if(!empty($erreurs['ville']) ) { echo('<p class="erreur" >'.$this -> e($erreurs['ville']).'</p>'); } ?>
			</p>

			<p>
				<label class="nostar" for="pays">Pays</label>
				<input type="text" name="pays" id="pays" value="France" value="<?php afficherPost('pays') ?>" />
				<?php  if(!empty($erreurs['pays']) ) { echo('<p class="erreur" >'.$this -> e($erreurs['pays']).'</p>'); } ?>
			</p>
			
			<p>
				<label for="telephone">Téléphone<span> *</span></label>
				<input type="text" name="telephone" id="telephone" value="<?php afficherPost('telephone') ?>" placeholder=" 00-00-00-00-00 " />
				<?php  if(!empty($erreurs['telephone']) ) { echo('<p class="erreur" >'.$this -> e($erreurs['telephone']).'</p>'); } ?>
			</p>
			<p>
				<label class="nostar" for="photo">Photo (jpg, tif, png) < 1 M°</label>
				<input class="photo" type="file" name="photo" id="photo"  />
				
			</p>
			<p>
				<label for="presentation">Présentation<span> *</span></label>
				<textarea name="presentation" id="presentation" placeholder="Ecrivez quelque chose sur vous ..." value="<?php afficherPost('presentation') ?>"></textarea>
				<?php  if(!empty($erreurs['presentation']) ) { echo('<p class="erreur" >'.$this -> e($erreurs['presentation']).'</p>'); } ?> 
			</p>

			<p>
				<input class="button" type="submit" name="Envoyer" value="Envoyer">
			</p>
		</div>
	</form>



<?php $this -> stop('main_content'); ?>

