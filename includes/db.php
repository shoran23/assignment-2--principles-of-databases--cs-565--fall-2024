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
    $colMod["released"] = substr($col["released"], 0, 4);
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

function getCurrentInventory(): array {
    try {
        $db = prepareDb();
        $statement = $db->prepare(
            "SELECT model, model_id, model_number, part_number, serial_number, devices.darwin AS current_darwin, models.darwin AS last_darwin, url FROM devices CROSS JOIN models USING(model_id)"
        );
        $statement->execute();
        return $statement->fetchAll();
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

// reformat this request
function getCurrentInventoryOs(): array {
    try {
        $db = prepareDb();
        $statement = $db->prepare(
    "SELECT model, model_release, device_release
            FROM (
                (SELECT model, release_name as model_release
                FROM models
                CROSS JOIN operating_systems USING(darwin)) AS model_releases
                CROSS JOIN
                    (SELECT model, release_name as device_release
                    FROM operating_systems
                    CROSS JOIN devices USING(darwin)
                    CROSS JOIN models USING(model_id)) AS device_releases
                USING(model))");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

