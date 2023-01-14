<?php

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $errors = [];
        if(empty($_POST['title'])) {
            $errors['title'] = 'Title is required';
        } 

        if(empty($_POST['description'])) {
            $errors['description']  = 'Description is required';
            
        } 

        if(empty($errors)) {
            $database->addBlog($_POST);
            header("Location: index.php");
        }
    }

?>