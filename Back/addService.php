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

    // Récupérer les informations du client à partir du formulaire

        $image       = "assets/about.png";
        $title          = $data->title;
        $description    = $data->description;
        $price       = $data->price;
        $category           = $data->category ;
        $consultantName = $data->consultantName;

    // Requête SQL
    $sql = 'INSERT INTO services (image, title, price, description, category,consultantName) 
            VALUES (?, ?, ?, ?, ?, ?)';
    $reponse = $con->prepare($sql);
    $reponse->execute([$image, $title, $price, $description, $category,$consultantName]);
    
    if ($reponse) {
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "service was created."));
    } else { // if unable to create the Etudient, tell the user
         // set response code - 503 service unavailable
         http_response_code(503);
  
         // tell the user
         echo json_encode(array("message" => "Unable to create service."));   
    }
?>