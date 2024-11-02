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
        $statement = $db->prepare("SELECT version_name, release_name, darwin, announced, released, last_darwin FROM operating_systems NATURAL JOIN dates ORDER BY announced");
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

function getCurrentInventory(): array {
    try {
        $db = prepareDb();
        $statement = $db->prepare("SELECT model, model_id, model_number, part_number, serial_number, darwin, last_darwin, url FROM devices NATURAL JOIN models");
        $statement->execute();
        return $statement->fetchAll();
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

function getCurrentInventoryOs(): array {
    try {
        $db = prepareDb();
        $statement = $db->prepare("DROP VIEW IF EXISTS DeviceReleaseNames");
        $statement->execute();
        $statement = $db->prepare("CREATE VIEW DeviceReleaseNames AS SELECT model, release_name as device_release FROM operating_system CROSS JOIN devices USING(darwin) CROSS JOIN models USING(model_id)");
        $statement->execute();
        $statement = $db->prepare("DROP VIEW IF EXISTS ModelsLastSupportReleaseNames");
        $statement->execute();
        $statement = $db->prepare("CREATE VIEW ModelsLastSupportReleaseNames AS SELECT model, release_name as model_release FROM operating_systems CROSS JOIN model USING(darwin)");
        $statement->execute();
        $statement = $db->prepare("SELECT model, device_release, model_release FROM DeviceReleaseNames CROSS JOIN ModelsLastSupportReleaseNames USING(model)");
        $statement->execute();
        return $statement->fetchAll();
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}
