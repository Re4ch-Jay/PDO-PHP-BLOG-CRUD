<?php

   $database = require './Database.php';


   $blogs= $database->getBlog();

   $currentBlog = [
    'title' => '',
    'description' => '',
   ];

   if(isset($_GET['id'])) {
        $currentBlog = $database->getById($_GET['id']);
        var_dump($currentBlog);
   }

?>

<?php include 'create.php' ?>


<?php include 'partials/head.php' ?>
<?php include 'partials/nav.php' ?>
<main class="container flex justify-content-center align-items center text-center py-5">
    <form method="post"">
        <div>
            <input class="my-5 form-control" type="text" name='title' placeholder="Blog Title"  value="<?= $currentBlog['title'] ?>" autocapitalize="">
        </div>
        <?php if (isset($errors['title'] )): ?>
            <h3 class="text-danger fs-5"><?= $errors['title'] ?></h3>
        <?php endif ?>
        <div>
            <textarea class="my-5 form-control" name="description" cols="30" rows="10" placeholder="Description"><?= $currentBlog['description'] ?></textarea>
        </div>
        <?php if (isset($errors['description'] )): ?>
            <h3 class="text-danger fs-5"><?= $errors['description'] ?></h3>
        <?php endif ?>
        <button type="submit" class="btn btn-primary my-5">Add new blog</button>
    </form>

    <div>
        <?php if(empty($blogs)): ?>
            <h3>There is no blog right now</h3>
        <?php endif ?>

        <?php foreach($blogs as $blog): ?>
            <a class="card py-3" href="edit.php/?id=<?= htmlspecialchars($blog['id']) ?>">
                <div>
                    <h3><?= htmlspecialchars($blog['title']) ?></h3>
                </div>
                <div>
                    <p><?= htmlspecialchars($blog['description']) ?></p>
                </div>
                <div>
                    <p><?= htmlspecialchars($blog['created_at']) ?></p>
                </div>
                <form action="delete.php" method="post">
                    <input type="hidden" for="delete" name="id" value="<?=htmlspecialchars($blog['id']) ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </a>
        <?php endforeach ?>
    </div>
</main>
<?php include 'partials/footer.php' ?>