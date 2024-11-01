<?php

function prepareDb(): PDO {
    include_once "config.php";

    $db = new PDO(
        "mysql:host=" . DBHOST . "; dbname=" . DBNAME . ";charset=utf8",
        DBUSER, DBPASS
    );
    return $db;
}

function getNumberOfVersions(): int {
    try {
        $db = prepareDb();
        $statement = $db->prepare("SELECT COUNT(*) FROM operating_systems");
        $statement->execute();
        $cols = $statement->fetchAll();
        return $cols[0]['COUNT(*)'];
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}
