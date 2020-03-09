<?php
function getDatabase() {
        
       $config = array(
            'DB_DNS' => 'mysql:host=ict.neit.edu;port=5500;dbname=se266_hguo',
            'DB_USER' => 'se266_hguo',
            'DB_PASSWORD' => 'hguo'
        );
       
        try {
            $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $db = null;
        }
        return $db;
}

$db = getDatabase();
