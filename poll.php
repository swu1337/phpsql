<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=poll", "root", "");
        $query = $db->prepare("SELECT * FROM poll");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <form action="#" method="POST">
        <?php
        foreach ($result as &$data) {
            echo "<p>Stelling van de maand: " . $data['vraag'] . '</p>';
            $query = $db->prepare("SELECT * FROM optie where poll =" . $data['id'] . "");
            $query->execute();
            $result1 = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result1 as $data1) {
                print_r($data1);
                echo "<input type='radio' name='optie' value=" . $data1['id'] . " />" . $data1['optie'];
                echo "<br />";
            }
        }
        ?>
            <input type="submit" name="Submit" value="Submit" />
        </form>
        <?php

        if(isset($_POST['Submit'])) {
            print_r($_POST);
            $id = filter_input(INPUT_POST, 'optie', FILTER_VALIDATE_INT);
            echo "Selected  Value" . $id;
            if(isset($id)) {
                $query = $db->prepare("UPDATE optie SET stemmen=stemmen+1 WHERE id=" . $id);
                echo print_r($query);
                //$query->bindParam("id", $id);

                if($query->execute()) {
                    echo "Thank you for the survey";
                } else {
                    echo "Something went wrong";
                }
            }
        }
    } catch(PDOException $e) {
        echo 'Error! :' . $e.getMessage();
    }
?>
