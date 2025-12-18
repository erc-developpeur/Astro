<?php

// Penser à mettre un index.php dans www qui redirige vers cet index là !
session_start();
include('../config/AppConfig.php');
include('../config/DbConfig.php');
include('../kernel/Connexion.php');

//controleurs
include('../controle/connexionControle.php');
include('../controle/accueilControle.php');
include('../controle/userControle.php');

// Vérifier les paramètres du GET

$controle='';
if (isset($_GET['controle']))
{
    $controle=$_GET['controle'];
}
	
$action='';
if (isset($_GET['action']))
{
    $action=$_GET['action'];
}

/*
 * L'action demandée est envoyée vers le controle associé à la page demandée
 * Cette action est orientée métier : ce que souhaite le client comme fonctionalités, indépendament de la notion de tables!
 */
switch ($controle) {
	case 'accueil' :
		accueilControle($action);
	break;
    case 'salle' :
        salleControle($action);
        break;
	case 'listes' :
		listesControle($action);
	break;
	case 'reservation' :
		reservationControle($action);
	break;
	case 'parametres' :
		parametresControle($action);
	break;
	case 'user' :
		userControle($action);
	break;
	case 'connexion' :
		connexionControle($action);
	break;
	default : // A défaut par sécurité, c'est direct retour à l'authentification
		connexionControle($action);
	break;
}

