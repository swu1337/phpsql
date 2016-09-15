<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=cijfersysteem", "root", "");
        $query = $db->prepare('SELECT * FROM cijfer');
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table>
            <tr>
                <th>Leerling</th>
                <th>Cijfer</th>
            <tr>
            <?php
                foreach($result as &$data) {
            ?>
            <tr>
                <?php
                    echo "<td>" . $data['leerling'] . "</td>";
                    echo "<td>" . $data['cijfer'] . "</td>";
                ?>
            </tr>
            <?php }
            ?>
        </table>
        <?php
    } catch(PDOException $e) {
        die("Error!: " . $e.getMessage());
    }
?>
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
