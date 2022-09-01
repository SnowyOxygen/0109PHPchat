<?php
    function SessionHandle(){
        // TODO: Check for existing users
        $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
        $pseudo =htmlspecialchars($_POST["pseudo"], ENT_QUOTES, 'UTF-8');
    }

?><!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="pragma">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./chat.css">
</head>
<body>
    <?php include('header.php') ?>
    <?php
        session_start();

        if(isset($_SESSION)){
            if(isset($_POST) && !empty($_POST)){
                include('chat.php');
            }
            else{
                include('connexion.php');
            }
        }
    ?>
</body>
</html>