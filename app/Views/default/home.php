<?php $this->layout('layout', ['title' => 'Noël : le meilleur jour pour partager !']) ?>

<?php $this->start('main_content') ?>

<div class="blocAccueil">
recherche des evenements
<form action="<?php echo $this->url('events'); ?>" method="POST" >
	<select name="style_soiree">
	  <option value="amicale">amicale</option>
	  <option value="familiale">familiale</option>
	  <option value="religieux">religieux</option>
	  <option value="non_defini">non_defini</option>
	</select>

	<select name="tranche_age">
	  <option value="0">0</option>
	  <option value="1">1</option>
	  <option value="2">2</option>
	  <option value="3">3</option>
	  <option value="4">4</option>
	</select>

	<select name="nbr_participants">
	  <option value="1 place">1 place</option>
	  <option value="2">2</option>
	  <option value="3">3</option>
	  <option value="+">+</option>
	</select>

	<input type="submit" value="Envoyer" />
</form>
</div><br/><br/>

<div>
	<h2>Seul a noel cette année ?</h2>
	<h3>nous vous proposons une alternative ...</h3>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac aliquet neque, vitae fringilla purus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer nec ipsum et risus ornare elementum at sit amet nisi. Pm erat. Nunc conleo eleifend, in volutpat libero maximus. Morbi iaculis euismod nulla. Fusce fringilla velit vitae orci lobortis molestie.

	Aliquam lacinia turpis non pretium vehicula. Nulla facilisi. Curabitur eget mauris .

	Proin et dui nec lorem commodo dignissim eu eu orci. Aenean sed vehicula metus. Ut efficitur, lectus porta molestie bibendum, erat libero faucibus purus, vitae iaculis justo ligula in ex. Nulla facilisi.

	Curaante, vel porttitor dolor diam in libero. Duis at consequat est. Vivamus erat orci, hendrerit non massa vitae, suscipit lacinia magna. Donec suscipit lacinia malesuada.</p>
	<a href="<?= $this->url('principe') ?>" title="principe">En savoir plus</a>
<!-- 	<button type="button">En savoir plus</button> -->
</div>

<div class="blocAccueil">
<!-- bloc famille -->
<img src="<?= $this->assetUrl('photos/header.jpg') ?>">
<!-- mettre le bouton en transparent 50% et au dessus de l'image -->
<!-- mettre un effet de survol sur tous les boutons de la page -->
<a href="<?= $this->url('events') ?>?style_soiree=familiale" title="events">y aller</a>
</div><br/><br/>


<div class="blocAccueil">
<!-- creation d'un compte -->
<img src="<?= $this->assetUrl('photos/inscription_2.jpg') ?>">
<a href="<?= $this->url('register') ?>" title="creation d'un compte">M'inscrire</a>
</div><br/><br/>


<div class="blocAccueil">
<!-- bloc religieux -->
<img src="<?= $this->assetUrl('photos/religieux.jpg') ?>">
<a href="<?= $this->url('events') ?>?style_soiree=religieux" title="events">y aller</a>
</div><br/><br/>







<div class="blocAccueil">
carte google map avec marqueurs	
</div><br/><br/>


	<p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p>
<?php $this->stop('main_content') ?>
 