<div class="form-wrapper">
<form action="#" method="POST">
    <label for="naam">Naam: </label>
    <input type="text" id="naam" name="naam" />
    <br />
    <br />
    <label for="text">Bericht:<label>
    <br />
    <textarea rows="4" cols="50" id="text" name="bericht"></textarea>
    <br />
    <input type="submit" name="Send" value="Send" />
</form>
</div>
<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=gastenboek","root","");
        if(isset($_POST['Send'])) {
            $naam = $_POST['naam'];
            $bericht = $_POST['bericht'];

            $query = $db->prepare("INSERT INTO bericht(naam,bericht) VALUES(:naam, :bericht)");
            $query->bindParam("naam", $naam);
            $query->bindParam("bericht", $bericht);
            if($query->execute()) {
                echo 'De nieuwe gegevens zijn toegevoegd';
            } else {
                echo 'Er is een gout opgetreden';
            }
        }
    } catch(PDOException $e) {
        die("Error!: " . $e->getMessage());
    }
?>
<?php
    try {
        echo "<br />";
        $query = $db->prepare("SELECT * FROM bericht");
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>
        <table>
            <tr>
                <th>Naam: </th>
                <th>Datum/Tijd: </th>
                <th>Bericht: </th>
            </tr>
        <?php
        foreach($result as &$data) {
        ?>
            <tr>
            <?php
                echo "<td>" . $data['naam'] . '</td>';
                echo "<td>" . $data['datumtijd'] . '</td>';
                echo "<td>" . $data['bericht'] . '</td>';
            ?>
            </tr>
        <?php
        }
        ?>
    </table>
    <?php
    } catch(PDOException $e) {
        echo "Error:" . $e.getMessage();
    }
    ?>

    <style>
        table {
          border-collapse: collapse;
          border: 1px solid black;
          margin-top: 20px;
        }

        td {
          border: 1px solid black;
          width: 100px;
        }

        .form-wrapper {
            border-bottom: 1px solid black;
        }
    </style>
