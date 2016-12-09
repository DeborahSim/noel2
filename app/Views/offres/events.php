<?php $this->layout('layout', ['title' => 'Principe du site !']) ?>

<?php $this->start('main_content');
$columns = array(
	'id' => 'id',
	'titre_soiree' => 'titre',
	'style_soiree' => 'style de la soirée',
	'theme_soiree' => 'theme de la soirée',
	'participation' => 'participation requise ?',
	'tranche_age' => 'tranche d\'age',
	'nbr_participants' => 'nombre de partcipants',
	'id_utilisateur' => 'id de l\'utilisateur',
	'photo' => 'photo de la soirée'
	); 
?>
<TABLE>
	<tr>
		<?php foreach($columns as $col){
		echo '<th>'.$col.'</th>';
			} ?>
	</tr>
	<?php
		foreach($records as $rec){
			echo "<tr>";
			foreach ($columns as $key => $value) {
				echo "<td>".$rec[$key]."</td>";
			}
			echo "</tr>";

		}
	?>
</TABLE>






<!-- <section class="events">
    <section class="blocLeft">
       <h2>Titre de la soirée</h2>
        <div class="photoSoiree"></div>

        <p>Theme</p>
        <p>Nombre de place</p>
        <p>Nombres d'invités enregistrés</p>

        <form action="" method="get">
            <textarea name="description" id="description"></textarea>
        </form>
    </section>

    <section class="blocAside">
        <h2>Organisateur</h2>

        <div class="photoOrganisateur"></div>

        <p>Nom :</p>
        <p>Ville</p>
        <p>Mail</p>
        <p>Tel</p>

        <form action="" method="post">
            <button type="submit" value="Contactez le">Contactez le</button>
            <button type="submit" value="Je participe">Je participe</button>
        </form>
    </section>

    <section class="blocContent">
        <div class="map"></div>

        <form action="" method="get">
            <textarea name="adresse" id="adresse"></textarea>
        </form>
    </section>
</section> -->














	<?php $this->stop('main_content') ?>