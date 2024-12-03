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

    $id             = $data->id;
    $category       = $data->category;
    $title          = $data->title;
    $description    = $data->description;
    $location       = $data->location;
    $date           = $data->date;
    $time           = $data->time;
    $organizer      = $data->organizer;

    // Requête SQL
    $sql = "UPDATE events SET 
                category = ?,
                title = ?,
                description = ?,
                location = ?,
                date = ?,
                time = ?,
                organizer = ?
            WHERE id = ?";

    $reponse = $con->prepare($sql);
    $reponse->execute([$category, $title, $description, $location, $date, $time, $organizer, $id]);
    
    if ($reponse) {
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Event was updated."));
    } else { // if unable to create the Etudient, tell the user
         // set response code - 503 service unavailable
         http_response_code(503);
  
         // tell the user
         echo json_encode(array("message" => "Unable to update event."));   
    }
?>