<?php

// need to refactor for neatness
function createTable($title, $headers, $keys, $cols): void {
    echo "<section>";
    echo "<h2>" . $title . "</h2>";
    echo    "<div>";
    echo        "<table>";
    echo            "<thead>";
    echo                "<tr>";
                        foreach ($headers as $header) {
    echo                    "<th>" . $header . "</th>";
                        }
    echo                "</tr>";
    echo            "</thead>";
    echo            "<tbody>";
                    foreach($cols as $col) {
    echo                "<tr>";
                        foreach ($keys as $key) {
                            if ($col[$key] == null) {
    echo                        "<td/>";
                            } else {
    echo                        "<td>";
                                if ($key == "url") {
    echo                            "<a href='" . $col[$key] . "'" . " target='_blank' rel='noopener' >Link</a>";
                                } else {
    echo                            $col[$key];
                                }
    echo                        "</td>";
                            }
                        }
    echo                "</tr>";
                    }
    echo            "</tbody>";
    echo        "</table>";
    echo    "</div>";
    echo "</section>";
}
