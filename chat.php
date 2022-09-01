<?php
    $JSONFile = file_get_contents("bdd.json");
    $JSONdata = json_decode($JSONFile, true);

    $userList = [
        // 1 => [
        //     "pseudo" => "johnDoe",
        //     "email" => "email@hallo.com"
        // ],
    ];
    $messageList = [];

    if(isset($_POST) && array_key_exists('chatInput', $_POST)){
        $newMessage = htmlspecialchars($_POST["chatInput"], ENT_QUOTES, 'UTF-8');
        WriteMessage($newMessage);
    }

    function GetUsers(){
        $userList = $JSONdata['USERS'];
    }

    function GetMessages(){
        $messageList = $JSONdata['MESSAGES'];
    }

    function WriteMessage($message){
        global $JSONdata;

        $JSONdata['MESSAGES'][ (count($messageList) + 1)] = [
                'content' => $message,
                'dateTime' => date("Y-m-d", time()),
                'userID' => $_SESSION['userID']
        ];
    }
?>
<link rel="stylesheet" href="./chat.css">
<div id="content">
    <div id="userBox">

        <ul id="userList">
            <!-- liste d'utilisateurs existants / en ligne -->
            <?php
                $userList = $JSONdata['USERS'];
                if(count($userList) > 0){
                    foreach ($userList as $key => $value) {
                        echo '<li id="userEl">' . $value['pseudo'] . '</li>';
                    }
                }
            ?>
        </ul>
    </div>

    <div id="messageBox">
        
        <div id="messageScroll">
            <ul id="messageList">
                <!-- Liste des messages envoyés -->
                <?php
                    $messageList = $JSONdata['MESSAGES'];
                    if(count($messageList) > 0){
                        foreach ($messageList as $key => $value) {
                            echo '
                            <li id="messageEl">
                                <p id="messageUser" class="offline">' . $userList[$value['userID']]['pseudo'] . '</p>
                                <p id="messageContent">' . $value['content'] . '</p>
                                <p id="messageTime">'. $value['time'] . '</p>
                            </li>
                            ';
                        }
                    }
                ?>
                
            </ul>
        </div>

        <form action="" method="post" id="inputBox">
            <input type="text" id="chatInput" name="chatInput" required maxlength="300" placeholder="Your text here">
            <input type="submit" name="submit" id="submit">
        </form>
    </div>

</div>