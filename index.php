<?php
require("includes/db.php");
require("includes/components.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Apple Macintosh Computer Inventory</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,200;0,500;1,200;1,500&display=swap">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Apple Macintosh Computer Inventory</h1>
    </header>
    <main>
        <section>
            <h2>How Many Versions of macOS Have Been Released?</h2>
            <div>
                <?php
                    echo "<p>There have been <b>" . getNumberOfVersions() . "</b> versions of macOS released thus far.</p>";
                ?>
            </div>
        </section>
        <?php
            $title = "Show the Version Name, Release Name, Official Darwin OS Number, Date Announced, Date Released, and Date of Latest Release of All macOS Versions, Listed by Date Order";
            $headers = ["Version Name", "Release Name", "Official Darwin OS Number", "Date Announced", "Date Released", "Date of Latest Release"];
            $keys = ["version_name", "release_name", "darwin", "announced", "released", "last_release"];
            $cols = getOperatingSystems();
            table($title, $headers, $keys, $cols);
        ?>

        <?php
            $title = "Show the Version Name (Release Name) and Year Released of all macOS Versions, Listed by Date Released";
            $headers = ["Version Name (Release Name)", "Year Released"];
            $keys = ["name", "released"];
            $cols = getOsVersionAndRelease();
            table($title, $headers, $keys, $cols);
        ?>

    </main>
</body>
</html>
