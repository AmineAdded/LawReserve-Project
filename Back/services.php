<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'connexion.php';

// Vérifier si le paramètre userName est fourni
if (isset($_GET['userName']) && !empty($_GET['userName'])) {
    $userName = htmlspecialchars(strip_tags($_GET['userName']));

    // Requête SQL avec filtre par consultantName
    $sql = 'SELECT * FROM services WHERE consultantName = :consultantName';
    $reponse = $con->prepare($sql);
    $reponse->bindParam(':consultantName', $userName);
} else {
    // Si aucun userName n'est fourni, retourner un message d'erreur
    echo json_encode(["message" => "userName is required"]);
    http_response_code(400); // Mauvaise requête
    exit;
}

// Exécuter la requête
$reponse->execute();
$services = $reponse->fetchAll(PDO::FETCH_ASSOC);

// Retourner les données en JSON
echo json_encode($services);
?>
