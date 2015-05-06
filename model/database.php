<!--
**** Author: Matthew Battyanyi
**** Revision Date: 5-5-15
**** File Name: model/datebase.php
**** Description: Datebase connection functions
-->

<?php
    $dsn = 'mysql:host=localhost;dbname=gregsgrub';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo "database error";
        exit();
    }
?>