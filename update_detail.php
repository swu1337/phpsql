<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=fietsenmaker","root", "");
        $merk = "";
        $type = "";
        $prijs = 0;

        if(isset($_POST['verzenden'])) {
            $merk = $_POST['merk'];
            $type = $_POST['type'];
            $prijs = $_POST['prijs'];

            if(!empty($merk) && !empty($type) && !empty($prijs)) {
                $query = $db->prepare("UPDATE fietsen SET merk = :merk,
                                                          type = :type,
                                                          prijs = :prijs
                                                          WHERE id = :id");
                $query->bindParam("merk", $merk);
                $query->bindParam("type", $type);
                $query->bindParam("prijs", $prijs);
                $query->bindParam("id", $_GET['id']);

                if($query->execute()) {
                    echo "De gegevens zijn aangepast.";
                } else {
                    echo "Er is een fout opgetreden.";
                }
                echo "<br />";
            } else {
                echo "Vul de formulier in";
            }
        } else {
            $query = $db->prepare("SELECT * FROM fietsen  WHERE id = :id");
            $query->bindParam('id', $_GET['id']);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $data) {
                $merk = $data['merk'];
                $type = $data['type'];
                $prijs = $data['prijs'];
            }
        }
    }
    catch (PDOException $e) {
        die('Error! :' . $e->getMessage());
    }
?>

<form method="post" action="#">
    <label>Merk</label>
    <input type="text" name="merk" value="<?= $merk;?>" /><br />
    <label>Type</label>
    <input type="text" name="type" value="<?= $type;?>" /><br />
    <label>Prijs</label>
    <input type="number" name="prijs" value="<?= $prijs;?>" /><br />

    <input type="submit" name="verzenden" value="Opslaan" />
</form>
