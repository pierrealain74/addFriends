<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php

require_once __DIR__ . '/../src/User.php';
require_once __DIR__ . '/_connec.php';
$pdo = new \PDO(DSN, USER, PASS);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname =  trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST["email"]);
    $description = trim($_POST["description"]);
    $age = trim($_POST["age"]);

    $user = new User($firstname, $lastname, $email, $description, $age);

    $errors = $user->validateForm();

    if (empty($errors)) 
    {
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
 

            $uploadDirectory = 'assets/images/';
            

            $tmpFilePath = $_FILES['photo']['tmp_name'];


            $fileExtension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

 
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($fileExtension, $allowedExtensions)) {
                $errors[] = "Extension de fichier non autorisée. Veuillez télécharger une image avec une extension JPG, JPEG, PNG ou GIF.";
            }


            $maxFileSize = 5 * 1024 * 1024; // 5 Mo (en octets)
            if ($_FILES['photo']['size'] > $maxFileSize) {
                $errors[] = "La taille du fichier dépasse la limite autorisée de 5 Mo.";
            }

            // Générer un nom de fichier unique basé sur le timestamp
            $newFileName = uniqid() . '.' . $fileExtension;

            // Chemin de destination complet pour la photo avec le nouveau nom
            $destFilePath = $uploadDirectory . $newFileName;

            // Déplacer le fichier téléchargé vers le dossier de destination
            if (!move_uploaded_file($tmpFilePath, $destFilePath)) {
                $errors[] = "Une erreur s'est produite lors du téléchargement de la photo.";
            }

            $inserted = $user->insertIntoDatabase($pdo, $newFileName);

            if ($inserted) {
                header("Location: index.php");
                exit;
            } else {
                $errors[] = "Une erreur s'est produite lors de l'insertion des données dans la base de données.";
            }
        } else {
            $errors[] = "Veuillez sélectionner une photo à télécharger.";
        }
    }





}

// Affichage des erreurs
if (!empty($errors)) {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo "</div>";
}





?>