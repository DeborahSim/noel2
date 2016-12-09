<!DOCTYPE html>
<html lang="fr">
<head>
	<title><?= $this->e($title) ?></title>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
</head>
<body>
	<div class="container">
		<header>
		<img class="header" src="<?= $this->assetUrl('photos/noel3.jpg') ?>">
			<h1><?= $this->e($title) ?></h1>
		</header>
		<nav>
			<ul>
				<li><a href="../public/" title="accueil">Accueil</a></li>
				<li><a href="<?= $this->url('principe') ?>" title="principe">Principe</a></li>
				<li><a href="<?= $this->url('events') ?>" title="les evenements">Evenements</a></li>
				<li><a href="<?= $this->url('register') ?>" title="creation d'un compte">M'inscrire</a></li>
				<li><a href="../public/#/" title="blog pour parler du site">On en parle ?</a></li>
			</ul>
		</nav>
		<section>
			<?= $this->section('main_content') ?>
		</section>

		<footer>
		<a href="#">Mentions legales</a>
		<p>Crée par Cédric-Kevin-Gilles-Kamel-Déborah</p>
		</footer>
	</div>
	<script
	  src="https://code.jquery.com/jquery-2.2.4.min.js"
	  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
	  crossorigin="anonymous"></script>
	 <script type="text/javascript" src="<?php echo $this-> assetUrl('js/script.js') ?>"></script>
</body>
</html>