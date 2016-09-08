<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=fietsenmaker","root", "");
        $query = $db->prepare("DELETE FROM fietsen WHERE id = 5");

        if($query->execute()) {
            echo 'Het item is verwijderd.';
        } else {
            echo 'Er is een fout opgetreden!';
        }
    }
    catch (PDOException $e) {
        die('Error! :' . $e->getMessage());
    }
?>
