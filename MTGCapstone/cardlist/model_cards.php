<?php

include (__DIR__ . '/db.php');

function getCards() {
    global $db;

    $results = [];
    $stmt = $db->prepare("SELECT magicId, magicName, magicManaCost, magicCMC, magicType, magicImageUrl, magicText FROM magiccards");
    
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return ($results);
}

function checkLogin($username, $password) {
    global $db;

    
    $stmt = $db->prepare("SELECT id FROM accounts WHERE username=:username AND password=:password");
    $binds = array(
        ":username" => $username,
        ":password" => $password
    );
    
    if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
         }
         
         return (implode("",$result));
}

/*$result = [];
        $stmt = $db->prepare("SELECT id, teamName, division FROM teams WHERE id=:id");
        $binds = array(
            ":id" => $id
        );
       
        if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        
         }
         
         return ($result);
*/
$a = checkLogin('test', '1');
$b = getCards();
//echo $a;
