<?php
    echo "Willekeurig wachtwoord van 10 tekens: " . substr(md5(uniqid(rand(), true)),0,9);
?>
