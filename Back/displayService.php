<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
  
  
    include_once 'connexion.php';

    $id = $_GET["id"];

    // Requête SQL
    $sql = "SELECT * FROM services WHERE id = $id";
    
    // Envoyer la requête au serveur et récupérer le résultat
    // le résultat peut être null si la requête est erronée
    $reponse = $con->prepare($sql);
    $reponse->execute();

    $service = $reponse->fetch(PDO::FETCH_ASSOC);

    echo json_encode($service);
?>