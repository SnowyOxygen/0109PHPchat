<?php
    $JSONFile = file_get_contents("bdd.json");
    $JSONdata = json_decode($JSONFile, true);

    GetData();

    $userList = [
        // 1 => [
        //     "pseudo" => "johnDoe",
        //     "email" => "email@hallo.com"
        // ],
    ];
    $messageList = [];

    //Check if user wrote a message
    if(isset($_POST) && array_key_exists('chatInput', $_POST)){
        $newMessage = htmlspecialchars($_POST["chatInput"], ENT_QUOTES, 'UTF-8');
        WriteMessage($newMessage);
    }

    //Update arrays
    function GetData(){
        global $messageList, $userList, $JSONdata;
        $messageList = $JSONdata['MESSAGES'];
        $userList = $JSONdata['USERS'];
    }

    //Save message to bdd.json
    function WriteMessage($message){
        global $JSONdata, $messageList;

        $JSONdata['MESSAGES'][strval(count($JSONdata['MESSAGES']) + 1)] = [
                'content' => $message,
                'dateTime' => date("Y-m-d", time()),
                'userID' => $_SESSION['userID']
        ];
        $encoded = json_encode($JSONdata);
        file_put_contents('bdd.json', $encoded);
    }
?>
<link rel="stylesheet" href="./chat.css">
<div id="content">
    <div id="userBox">

        <ul id="userList">
            <!-- liste d'utilisateurs existants / en ligne -->
            <!-- TODO: Bug de duplication des comptes -->
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
                <!-- TODO: check bdd.json and client data -->
                <?php
                    $messageList = $JSONdata['MESSAGES'];
                    if(count($messageList) > 0){
                        foreach ($messageList as $key => $value) {
                            echo '
                            <li id="messageEl">
                                <p id="messageUser" class="offline">' . $userList[$value['userID']]['pseudo'] . '</p>
                                <p id="messageContent">' . $value['content'] . '</p>
                                <p id="messageTime">'. $value['dateTime'] . '</p>
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