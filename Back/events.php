<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
  
    include_once 'connexion.php';

    // Requête SQL
    $sql = 'SELECT * FROM categorys';
    
    // Envoyer la requête au serveur et récupérer le résultat
    // le résultat peut être null si la requête est erronée
    $reponse = $con->prepare($sql);
    $reponse->execute();

    $categorys = $reponse->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($categorys);
?>