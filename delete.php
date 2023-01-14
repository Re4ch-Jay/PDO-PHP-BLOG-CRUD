<?php

    $database = require './Database.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $database->removeBlog($_POST['id']);

        header("Location: index.php");
    }

?>