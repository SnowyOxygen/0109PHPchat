<?php
    $userList = [
        // "ID (int)" => [
        //     "pseudo" => "johnDoe (text)";
        //     "email" => "email@hallo.com (text)"
        // ]
        1 => [
            "pseudo" => "johnDoe",
            "email" => "email@hallo.com"
        ],
        2 => [
            "pseudo" => "foobar",
            "email" => "wat@quoi.com"
        ],
        3 => [
            "pseudo" => "jesus",
            "email" => "christ@google.com"
        ],
        4 => [
            "pseudo" => "macdonald",
            "email" => "burg@er.com"
        ]
    ];
    $messageList = [
        1 => [
            "content" => "This method uses JavaScript to execute a PHP function with onclick() event.",
            "time" => "11:46 - 01/09/2022",
            "user" => 1
        ]
    ];
?>
<link rel="stylesheet" href="./chat.css">
<div id="content">
    <div id="userBox">

        <ul id="userList">
            <!-- liste d'utilisateurs existants / en ligne -->
            <?php
                if(count($userList) > 0){
                    foreach ($userList as $key => $value) {
                        echo '<li id="userEl">' . $value['pseudo'] . '</li>';
                    }
                }
            ?>
        </ul>
    </div>

    <div id="messageBox">
        <ul id="messageList">
            <!-- Liste des messages envoyés -->

            <!-- Examples -->
            <li id="messageEl">
                <p id="messageUser" class="online">User 2</p>
                <p id="messageContent">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur minus voluptate quo fugit officia deserunt sapiente, enim quasi, magni ratione ea accusantium, aspernatur vel expedita dicta nam voluptatum quibusdam veritatis.</p>
                <p id="messageTime">11 : 03</p>
            </li>
            <li id="messageEl">
                <p id="messageUser" class="offline">User 1</p>
                <p id="messageContent">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur minus voluptate quo fugit officia deserunt sapiente, enim quasi, magni ratione ea accusantium, aspernatur vel expedita dicta nam voluptatum quibusdam veritatis.</p>
                <p id="messageTime">11 : 05</p>
            </li>
            <?php
                if(count($messageList) > 0){
                    foreach ($messageList as $key => $value) {
                        echo '
                        <li id="messageEl">
                            <p id="messageUser" class="offline">' . $userList[$value['user']]['pseudo'] . '</p>
                            <p id="messageContent">' . $value['content'] . '</p>
                            <p id="messageTime">'. $value['time'] . '</p>
                        </li>
                        ';
                    }
                }
            ?>
        </ul>
    </div>

</div>