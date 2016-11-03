<?php
    require_once('querybuilder.php');
    $db = new QueryBuilder("sligro_groothandel");

    $facturen = $db->getFacturen();
    foreach($facturen as &$factuur) {
        $klant = $db->getTableById("klant", $factuur['klant_id']);
        echo "<a href='detail.php?id=" . $factuur['id'] . "'>";
        echo $klant["naam"];
        echo '</a>';
        echo '<br />';
    }
?>
