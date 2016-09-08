<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=fietsenmaker","root", "");

        if(isset($_GET['id'])) {
            $query = $db->prepare("DELETE FROM fietsen WHERE id = :id");
            $query->bindParam("id", $_GET['id']);

            if($query->execute()){
                echo "Het item is verwijderd <br />";
            } else {
                echo "Er is een fout opgetreden";
            }
        }
    }
    catch (PDOException $e) {
        die('Error! :' . $e->getMessage());
    }

    $query = $db->prepare('SELECT * FROM fietsen');
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach($result as &$data) {
        echo "<a href='delete_detail.php?id=" . $data['id'] . "'>";
        echo $data['merk'] . " " . $data['type'];
        echo '</a>';
        echo '<br />';
    }
?>
