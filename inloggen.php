<?php session_start();
    try {
        $db = new PDO("mysql:host=localhost;dbname=fietsenmaker", "root", "");

        if(isset($_POST['inloggen'])) {
            $username = $_POST['username'];
            $password = sha1($_POST['password']);

            $query = $db->prepare("SELECT * FROM gebruikers WHERE username=:user AND password=:pass");
            $query->bindParam("user", $username);
            $query->bindParam("pass", $password);

            $query->execute();
            if($query->rowCount() == 1) {
                $_SESSION['login'] = true;
                $_SESSION['username'] = $username;
            } else {
                echo 'Onjuiste gegevens';
            }
            echo '<br />';
        }
    } catch(PDOException $e) {
        die("Error! : " . $e->getMessage());
    }
?>

<form action="#" method="POST">
    <label>Username</label>
    <input type="text" name="username" />
    <br />
    <label>Password</label>
    <input type="password" name="password"/>
    <br />

    <input type="submit" name="inloggen" value="Inloggen" />
</form>

<?php
    if(isset($_SESSION['login'])) {
        header("location: profile.php");
    } else {
        echo 'Please login';
    }
 ?>
