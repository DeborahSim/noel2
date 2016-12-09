<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET|POST', '/login', 'Utilisateurs#login', 'login' ],
		['GET|POST', '/register', 'Utilisateurs#register', 'register'],
		['GET|POST', '/events/', 'Offres#event', 'events'],
		['GET', '/principe', 'Default#principe', 'principe'],
		['GET', '/famille', 'Default#evenementFamille', 'famille']


	);

