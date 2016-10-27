<?php
    include_once("querybuilder.php");
    $db = new QueryBuilder("sligro_groothandel");

    if(isset($_GET['id'])) {
        $factuur_id = $_GET['id'];

        $factuur = $db->getTableById('factuur', $factuur_id);
        $bedrijf = $db->getTableById('bedrijf', $factuur['bedrijf_id']);
        $klant = $db->getTableById('klant', $factuur['klant_id']);
        $artikelen = $db->getBesteldeArtikelen($factuur_id);
        $prijs_details = $db->getTotaal($artikelen, $factuur['korting']);
        print_r($prijs_details);
    }
?>

<table>
    <tr>
        <td>
            <?php
                foreach (array_reverse($bedrijf) as $key => $value) {
                    if($key !== "id") {
                        echo "<p>$value</p>";
                    }
                }
            ?>
        </td>
        <td>
            <p><?= "Factuurcode: $factuur_id"?></p>
            <p><?= "Datum: " . $factuur["datum"]; ?></p>
        </td>
    </tr>
    <?php
        foreach ($klant as $key => $value) {
            if($key !== "id") {
                echo "<tr>";
                echo "<td>" . ucfirst($key) . "</td>";
                echo "<td> $value </td>";
                echo "</tr>";
            }
        }
    ?>
    <tr>
        <th>art.nr</th>
        <th>omschrijving</th>
        <th>aantal</th>
        <th>prijs</th>
        <th>bedrag</th>
    </tr>
    <?php
        foreach($artikelen as $artikel) {
            echo "<tr>";
            echo "<td>" . $artikel['id'] . "</td>";
            echo "<td>" . $artikel['omschrijving'] . "</td>";
            echo "<td>" . $artikel['aantal'] . "</td>";
            echo "<td>" . $artikel['prijs'] . "</td>";
            echo "<td>" . $artikel['prijs'] * $artikel['aantal']  . "</td>";
            echo "</tr>";
        }
    ?>
</table>

<html>
  <head>
  </head>
  <body>
    <style>
        table {
          border-collapse: collapse;
          border: 1px solid black;
        }

        td {
          border: 1px solid black;
          width: 100px;
        }
    </style>
  </body>
</html>
