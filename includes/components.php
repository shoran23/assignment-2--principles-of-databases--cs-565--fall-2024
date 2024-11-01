<?php

function table($title, $headers, $keys, $cols) {
    echo "<section>";
    echo    "<h2>" . $title . "</h2>";
    echo    "<div>";
    echo        "<table>";
    echo            "<thead>";
    echo                "<tr>";
                        foreach ($headers as $header) {
                            echo "<th>" . $header . "</th>";
                        }
    echo                "</tr>";
    echo            "</thead>";
    echo            "<tbody>";
                    foreach($cols as $col) {
                        echo "<tr>";
                        foreach ($keys as $key) {
                            if($col[$key] != null) {
                                echo "<td>" . $col[$key] . "</td>";
                            }
                        }
                        echo "</tr>";
                    }
    echo            "</tbody>";
    echo        "</table>";
    echo    "</div>";
    echo "</section>";
}
