<?php

class Database
{
    private $pdo = null, $statement;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:server=localhost;dbname=blog;port=3307', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "ERROR: " . $exception->getMessage();
        }

    }

    public function getBlog()
    {
        $this->statement = $this->pdo->prepare("SELECT * FROM blog");
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addBlog($blog)
    {
        $this->statement = $this->pdo->prepare("INSERT INTO blog (title, description)
                                    VALUES (:title, :description)");
        $this->statement->bindValue('title', $blog['title']);
        $this->statement->bindValue('description', $blog['description']);
        return $this->statement->execute();
    }

    public function removeBlog($id) {
        $this->statement = $this->pdo->prepare("DELETE FROM blog WHERE id=:id");
        $this->statement->bindValue('id', $id);
        return $this->statement->execute();
    }

    public function getById($id) {
        $this->statement = $this->pdo->prepare("SELECT * FROM blog WHERE id=:id");
        $this->statement->bindValue('id', $id);
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $blog) {
        $this->statement = $this->pdo->prepare("UPDATE blog SET title = :title, description = :description WHERE id = :id");
        $this->statement->bindValue('id', $id);
        $this->statement->bindValue('title', $blog['title']);
        $this->statement->bindValue('description', $blog['description']);
        return $this->statement->execute();
    }
    
}

return new Database();