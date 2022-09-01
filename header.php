<header>
    <h1>Real time chat</h1>
    <?php
        if(isset($_POST) && !empty($_POST)){
            // echo '
            // <style>
            // button#deconnexion{
            //     font-size: 1.2em;
            //     margin-left: 3em !important;
            //     height: 30px;
            // }</style>
            // ';
            echo '<link rel="stylesheet" href="./chat.css">';
            echo '<p id="selfPseudo">' . $_POST["pseudo"] . '</p>';
            echo '<button id="deconnexion" name="deconnexion" onclick="' . 'window.location.href="?action=disconnect"' . '">Disconnect</button>'; 
            // TODO: fix $get action=disconnect
        }

        if(isset($_GET) && !empty($_GET) && $_GET['action'] == 'disconnect'){
            echo '<p id="connect">disconnect</p>';
            unset($_POST);
            unset($_GET);
            session_destroy();
        }
    ?>
</header>