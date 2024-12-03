<?php 
     // required headers
     header("Access-Control-Allow-Origin: *");
     header("Content-Type: application/json; charset=UTF-8");
     header("Access-Control-Allow-Methods: POST");
     header("Access-Control-Max-Age: 3600");
     header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
   
     include_once 'connexion.php';
     // get posted data from json input
    // and transforme it to an object
    $data = json_decode(file_get_contents("php://input"));

    $consultantName=$data->consultantName;
    $client=$data->client;
    $service=$data->service;
    $price=$data->price;
    $date=$data->date;

    
    // Requête SQL
    $sql = 'INSERT INTO appointment (law, client, service, price, date) 
            VALUES (?, ?, ?, ?, ?)';
    $reponse = $con->prepare($sql);
    $reponse->execute([$consultantName, $client, $service, $price, $date]);
    
    if ($reponse) {
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "appointment was created."));
    } else { // if unable to create the Etudient, tell the user
         // set response code - 503 service unavailable
         http_response_code(503);
  
         // tell the user
         echo json_encode(array("message" => "Unable to create appointment."));   
    }
?>