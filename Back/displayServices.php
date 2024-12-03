<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once 'connexion.php';

// Requête SQL pour récupérer tous les services
$sql = "SELECT * FROM services";

// Préparation et exécution de la requête
$reponse = $con->prepare($sql);
$reponse->execute();

// Récupérer tous les services
$services = $reponse->fetchAll(PDO::FETCH_ASSOC);

// Retourner la réponse en format JSON
echo json_encode($services);
?>
