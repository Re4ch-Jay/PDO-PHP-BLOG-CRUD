<?php

    $database = require './Database.php';

    $currentBlog = [
    'title' => '',
    'description' => '',
    ];

    $id = $_GET['id'];

    if(isset($id)) {

        $currentBlog = $database->getById($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            $errors = [];
            if(empty($_POST['title'])) {
                $errors['title'] = 'Title is required';
                
            } 
    
            if(empty($_POST['description'])) {
                $errors['description']  = 'Description is required';
                
            } 
    
            if(empty($errors)) {
                $database->update($id, $_POST);
                header("Location: /");
            }
        }
    }

    

?>

<?php include 'partials/head.php' ?>
<?php include 'partials/nav.php' ?>
<main class="container flex justify-content-center align-items center text-center py-5">

    <form method="post">
        <div>
            <input class="my-5 form-control type="text" name='title' placeholder="Blog Title"  value="<?= $currentBlog['title'] ?>" autocapitalize="">
        </div>
        <?php if (isset($errors['title'] )): ?>
            <h3 class="text-danger fs-5 ><?= $errors['title'] ?></h3>
        <?php endif ?>
        <div>
            <textarea class="my-5 form-control name="description" cols="30" rows="10" placeholder="Description"><?= $currentBlog['description'] ?></textarea>
        </div>
        <?php if (isset($errors['description'] )): ?>
            <h3 class="text-danger fs-5><?= $errors['description'] ?></h3>
        <?php endif ?>
        <a href="/" type="submit" class="btn btn-success my-5">Back</a>
        <button type="submit" class="btn btn-primary my-5">Update</button>
      
    </form>
</main>

    <?php include 'partials/footer.php' ?>