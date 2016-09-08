<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=fietsenmaker","root", "");
        $query = $db->prepare("UPDATE fietsen SET prijs = 849 WHERE id = 3");

        if($query->execute()) {
            echo 'De prijs is aangepast';

        } else { echo 'Er is een fout opgetreden.'; }
    }
    catch (PDOException $e) {
        die('Error! :' . $e->getMessage());
    }
