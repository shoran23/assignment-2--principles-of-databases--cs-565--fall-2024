<?php
require("includes/db.php");
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
    </main>
</body>
</html>
