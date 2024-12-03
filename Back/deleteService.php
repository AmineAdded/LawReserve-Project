<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
    include_once 'connexion.php';

    // get posted data from json input
    // and transforme it to an object
    $serviceId = $_GET["id"];
    
    // Supprimer le client avec l'id récupéré
    // Préparer la requête SQL
    $sql = "DELETE FROM services WHERE id = ?";
    $reponse = $con->prepare($sql);
    // Exécuter le requête
    $reponse->execute([$serviceId]);

    if ($reponse) {
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Service was deleted."));
    } else { // if unable to create the Etudient, tell the user
         // set response code - 503 service unavailable
         http_response_code(503);
  
         // tell the user
         echo json_encode(array("message" => "Unable to delete Service."));   
    }
?>