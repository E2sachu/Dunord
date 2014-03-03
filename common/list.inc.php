<?php
	Config::setKey('MATERIAL_TYPE', array(
		'r' => 'Retroprojecteur',
		'd' => 'Ordinateur de bureau',
		'l' => 'Ordinateur portable',
		'i' => 'Imprimante',
		't' => 'Tablette',
		's' => 'Smartphone',
		'f' => 'Télécopie',
		'p' => 'Téléphone fix',
		'x' => 'Autre',
	));

	Config::setKey('SERVICE', array(
		'a' => 'Administration',
		'c' => 'Commercial',
		'r' => 'Accueil',
		'l' => 'Logistique',
		'h' => 'Ressource humaine',
		'd' => 'Direction',
		's' => 'Salle de réunion',
		'i' => 'Informatique',
		'x' => 'Autre', 
	));

	Config::setKey('RIGHT',array(
		'1' => 'niveau 1',
		'2' => 'niveau 2',
		'5' => 'administrateur'
	));
?>