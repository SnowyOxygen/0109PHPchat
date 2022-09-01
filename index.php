<?php
    $JSONFile = file_get_contents("bdd.json");
    $JSONdata = json_decode($JSONFile, true);

    function SessionHandle(){
        $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
        $pseudo = htmlspecialchars($_POST["pseudo"], ENT_QUOTES, 'UTF-8');

        CheckUser($email, $pseudo);
    }

    function CheckUser(string $email, string $pseudo){
        global $JSONdata, $JSONFile;

        $users = $JSONdata['USERS'];

        foreach ($users as $key => $value) {
            $candidatePseudo = $value['pseudo'];
            $candidateEmail = $value['email'];

            if(
                $email == $candidateEmail &&
                $pseudo == $candidatePseudo
            ){
                $_SESSION['userID'] = $key;
                return true;
            }else { AddUser($email, $pseudo); }
        }

        return false;
    }

    function AddUser(string $email, string $pseudo){
        global $JSONdata, $JSONFile;

        $JSONdata['USERS'][strval(count($JSONdata['USERS']) + 1)] = [
            'pseudo' => $pseudo,
            'email' => $email
        ];
        
        $_SESSION['userID'] = strval(count($JSONdata['USERS']));
        $encoded = json_encode($JSONdata);
        file_put_contents('bdd.json', $encoded);
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
                SessionHandle();
                include('chat.php');
            }
            else{
                include('connexion.php');
            }
        }
    ?>
</body>
</html>