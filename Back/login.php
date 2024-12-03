<?php
// Autoriser les requêtes OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit();
}
session_start();
    // required headers
    header("Access-Control-Allow-Origin: *"); // Ou limiter à http://localhost:8081 si nécessaire
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    

include_once 'connexion.php'; // Inclure le fichier de connexion à la base de données

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['email'])) {
    echo json_encode([
        "message" => "Already logged in",
        "role" => $_SESSION['role'] // Retourne le rôle si déjà connecté
    ]);
    exit();
}

// Vérifier si le formulaire a été soumis via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lire les données envoyées depuis le frontend (JSON)
    $data = json_decode(file_get_contents("php://input"), true);
    var_dump($data);
    echo json_encode([
        "received_data" => $data
    ]);
    exit();

    // Vérifier si les champs requis (email et password) sont présents
    if (!isset($data['email']) || !isset($data['password'])) {
        http_response_code(400); // Mauvaise requête
        echo json_encode(["message" => "Email and password are required."]);
         exit();
    }

    $email = $data['email'];
    $password = $data['password'];

    try {
        // Vérifier si l'utilisateur est un lawyer ou un client
        $table = (strpos($email, '@lawyer.com') !== false) ? 'lawyers' : 'clients';

        // Préparer la requête pour récupérer l'utilisateur depuis la bonne table
        $sql = "SELECT * FROM $table WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && $password===$user['password']) {
            // Déterminer le rôle en fonction de la table
            $role = ($table === 'lawyers') ? 'lawyer' : 'client';

            // Stocker les informations dans la session
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $role;

            // Retourner une réponse JSON avec le rôle
            echo json_encode([
                "message" => "Login successful",
                "role" => $role
            ]);
            exit();
        } else {
            // Si les identifiants sont incorrects
            http_response_code(401); // Non autorisé
            echo json_encode(["message" => "Invalid email or password."]);
            exit();
        }
    } catch (Exception $e) {
        // Gérer les erreurs de base de données
        http_response_code(500); // Erreur serveur
        echo json_encode(["message" => "An error occurred.", "error" => $e->getMessage()]);
        exit();
    }
}
// Si aucune donnée n'est envoyée via POST
http_response_code(405); // Méthode non autorisée
echo json_encode(["message" => "Method not allowed."]);
exit();
?>
