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

function getOperatingSystems(): array {
    try {
        $db = prepareDb();
        $statement = $db->prepare("SELECT version_name, release_name, darwin, announced, released, last_release FROM operating_systems NATURAL JOIN dates ORDER BY announced");
        $statement->execute();
        return $statement->fetchAll();
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}


function modifyVersionCol($col) {
    $colMod["name"] = $col["version_name"] . " (" . $col["release_name"] . ")";
    $colMod["released"] = $col["released"];
    return $colMod;
}
function getOsVersionAndRelease(): array {
    try {
        $db = prepareDb();
        $statement = $db->prepare("SELECT version_name, release_name, released FROM operating_systems NATURAL JOIN dates ORDER BY released");
        $statement->execute();
        return array_map("modifyVersionCol", $statement->fetchAll());
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}
